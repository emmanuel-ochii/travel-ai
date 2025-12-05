<?php

namespace App\Services;

use App\Models\User;
use App\Models\Flight;
use App\Models\PopularRoute;
use App\Services\AI\GroqLLMService;
use App\Services\AI\LocalRecommender;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TravelRecommendationService
{
    protected User $user;
    protected LocalRecommender $localRecommender;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->localRecommender = new LocalRecommender();
    }

    /**
     * Get travel recommendations.
     *
     * @param int $limit
     * @param bool $useLlm
     * @return Collection
     */
    public function getRecommendations(int $limit = 5, bool $useLlm = false): Collection
    {
        $cacheKey = "user_{$this->user->id}_recommendations_" . ($useLlm ? 'llm' : 'local') . "_limit{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($limit, $useLlm) {

            /** -------------------------------------------------------
             *  🧠 STEP 1 — Determine personalization source
             * ------------------------------------------------------- */
            $signals = \App\Services\UserPreferenceAnalyzer::getUserSignals();

            $origin = null;
            $destination = null;

            if (!empty($signals['top_route'])) {
                [$origin, $destination] = explode('-', $signals['top_route']);

            } else {
                // fallback: use booking history
                $lastBooking = $this->user->bookings()->latest()->first();
                $origin = optional($lastBooking->flight->origin)->iata ?? null;
                $destination = optional($lastBooking->flight->destination)->iata ?? null;
            }

            // If still no data → use trending routes
            if (!$origin || !$destination) {
                $popular = PopularRoute::orderBy('search_count', 'desc')->first();

                if ($popular) {
                    $origin = $popular->origin;
                    $destination = $popular->destination;
                }
            }

            // final fallback if NO personalization data exists
            if (!$origin || !$destination) {
                return Flight::inRandomOrder()->take($limit)->get();
            }


            /** -------------------------------------------------------
             *  ✈️ STEP 2 — Generate baseline local recommendations
             * ------------------------------------------------------- */
            $recommendations = $this->localRecommender
                ->recommend($origin, $destination, $limit * 2);

            $recommendations = $recommendations->map(fn($item) => [
                'flight' => is_array($item) && isset($item['flight']) ? $item['flight'] : $item,
                'score' => $item['score'] ?? 0,
                'reason' => strval($item['reason'] ?? ''),
            ]);


            /** -------------------------------------------------------
             *  🤖 STEP 3 — Apply LLM intelligence (optional)
             * ------------------------------------------------------- */
            if ($useLlm && $recommendations->isNotEmpty() && config('services.groq.key')) {

                $context = [
                    'persona' => $this->user->persona,
                    'recent_bookings' => $this->user->bookings()->latest()->take(8)->get()->toArray(),
                    'signals' => $signals, // 🚀 extra context for LLM reasoning
                    'candidates' => $recommendations->map(fn($f) => [
                        'id' => $f['flight']->id,
                        'origin' => $f['flight']->origin->iata,
                        'destination' => $f['flight']->destination->iata,
                        'depart_at' => $f['flight']->depart_at->toIso8601String(),
                        'price' => optional($f['flight']->fares->sortBy('price_cents')->first())->price_cents / 100,
                    ])->values()->all(),
                ];

                $llm = app(GroqLLMService::class);

                try {
                    $llmRecommendations = $llm->getRecommendations($context);
                } catch (\Exception $e) {
                    logger()->error("Groq LLM failed: " . $e->getMessage());
                    $llmRecommendations = [];
                }

                $byId = $recommendations->keyBy(fn($f) => $f['flight']->id);

                foreach ($llmRecommendations as $rec) {
                    if (!isset($byId[$rec['flight_id']]))
                        continue;

                    $flightItem = $byId[$rec['flight_id']];
                    $localScore = $flightItem['score'];
                    $llmScore = min(1, max(0, $rec['score']));

                    // Weighted scoring
                    $flightItem['score'] = ($localScore * 0.6) + ($llmScore * 0.4);

                    // Append LLM reasoning
                    $llmReason = strval($rec['reason'] ?? '');
                    $flightItem['reason'] = $flightItem['reason']
                        ? $flightItem['reason'] . '; ' . $llmReason
                        : $llmReason;

                    $byId[$rec['flight_id']] = $flightItem;
                }

                $recommendations = collect($byId);
            }


            /** -------------------------------------------------------
             *  📦 STEP 4 — Format & return response
             * ------------------------------------------------------- */
            return $recommendations
                ->sortByDesc('score')
                ->take($limit)
                ->map(function ($item) {
                    $flight = $item['flight'];
                    $flight->score = $item['score'];
                    // $flight->reason = $item['reason'] ?: 'Recommended based on your travel interest';
                    $flight->reason = trim((string) ($item['reason'] ?? ''));
                    return $flight;
                });
        });
    }
}
