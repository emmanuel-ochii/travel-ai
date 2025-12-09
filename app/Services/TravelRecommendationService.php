<?php

namespace App\Services;

use App\Models\PopularRoute;
use App\Services\AI\LocalRecommender;
use App\Services\AI\GroqLLMService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Services\UserPreferenceAnalyzer;

class TravelRecommendationService
{
    protected $user;
    protected LocalRecommender $localRecommender;

    public function __construct($user)
    {
        $this->user = $user;
        $this->localRecommender = new LocalRecommender($user->id ?? null);
    }

    public function getRecommendations(int $limit = 5, bool $useLlm = false): Collection
    {
        // Determine route for personalization
        $signals = UserPreferenceAnalyzer::getUserSignals();
        $topRoute = $signals['top_route'] ?? null;

        if ($topRoute) {
            [$origin, $destination] = explode('-', $topRoute);
        } else {
            $origin = $destination = null;
        }

        // Fallback to last booking
        if (!$origin || !$destination) {
            $lastBooking = $this->user->bookings()->latest()->first();
            $origin = $origin ?? $lastBooking?->flight?->origin?->iata;
            $destination = $destination ?? $lastBooking?->flight?->destination?->iata;
        }

        // Fallback to popular routes
        if (!$origin || !$destination) {
            $popular = PopularRoute::orderBy('search_count', 'desc')->first();
            if ($popular) {
                $origin = $origin ?? $popular->origin;
                $destination = $destination ?? $popular->destination;
            }
        }

        // If still missing route → cold start: return empty
        if (!$origin || !$destination) {
            return collect();
        }

        // -------------------------
        // Cache Key per user + route + LLM
        // -------------------------
        $cacheKey = "user_{$this->user->id}_recommendations_{$origin}_{$destination}_" . ($useLlm ? 'llm' : 'local');

        return Cache::remember($cacheKey, now()->addDay(), function () use ($origin, $destination, $limit, $useLlm, $signals) {

            // -------------------------
            // STEP 1 — Local Recommender baseline
            // -------------------------
            $recommendations = $this->localRecommender
                ->recommend($origin, $destination, $limit * 2)
                ->map(fn($item) => [
                    'flight' => is_array($item) && isset($item['flight']) ? $item['flight'] : $item,
                    'score' => $item['score'] ?? 0,
                    'reason' => strval($item['reason'] ?? ''),
                ]);

            // -------------------------
            // STEP 2 — LLM Enhancement (Optional)
            // -------------------------
            if ($useLlm && $recommendations->isNotEmpty() && config('services.groq.key')) {

                $context = [
                    'persona' => $this->user->persona,
                    'recent_bookings' => $this->user->bookings()->latest()->take(8)->get()->toArray(),
                    'signals' => $signals,
                    'candidates' => $recommendations->map(fn($f) => [
                        'id' => $f['flight']->id ?? null,
                        'origin' => $f['flight']->origin?->iata ?? null,
                        'destination' => $f['flight']->destination?->iata ?? null,
                        'depart_at' => $f['flight']->depart_at?->toIso8601String() ?? null,
                        'price' => optional($f['flight']->fares->sortBy('price_cents')->first())->price_cents / 100 ?? null,
                    ])->values()->all(),
                ];

                $llm = app(GroqLLMService::class);
                try {
                    $llmRecommendations = $llm->getRecommendations($context);
                } catch (\Exception $e) {
                    logger()->error("Groq LLM failed: " . $e->getMessage());
                    $llmRecommendations = [];
                }

                $byId = $recommendations->keyBy(fn($f) => $f['flight']->id ?? null);

                foreach ($llmRecommendations as $rec) {
                    $flightId = $rec['flight_id'] ?? null;
                    if (!$flightId || !isset($byId[$flightId]))
                        continue;

                    $flightItem = $byId[$flightId];
                    $localScore = floatval($flightItem['score']);
                    $llmScore = min(1, max(0, floatval($rec['score'] ?? 0)));

                    // Weighted scoring: 60% Local, 40% LLM
                    $flightItem['score'] = round(($localScore * 0.6) + ($llmScore * 0.4), 2);
                    $flightItem['reason'] = strval($rec['reason'] ?? '');
                    $flightItem['llm_influenced'] = true;

                    $byId[$flightId] = $flightItem;
                }

                $recommendations = collect($byId)->values();
            }

            // -------------------------
            // STEP 3 — Filter by exact route
            // -------------------------
            $recommendations = $recommendations->filter(
                fn($item) =>
                $item['flight']->origin->iata === $origin &&
                $item['flight']->destination->iata === $destination
            );

            // -------------------------
            // STEP 4 — Sort and limit
            // -------------------------
            $sorted = $recommendations->sortByDesc('score');
            return $sorted->take($limit)->map(function ($item) {
                $flight = $item['flight'];
                $flight->score = $item['score'] ?? 0;
                $flight->reason = trim((string) ($item['reason'] ?? ''));
                $flight->llm_influenced = !empty($item['llm_influenced']);
                return $flight;
            });
        });
    }

}
