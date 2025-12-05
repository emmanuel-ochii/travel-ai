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

            // Safely handle top_route
            $topRoute = $signals['top_route'] ?? null;
            if ($topRoute) {
                [$origin, $destination] = explode('-', $topRoute);
            } else {
                $origin = $destination = null;
            }

            // Fallback to last booking if no top_route
            if (!$origin || !$destination) {
                $lastBooking = $this->user->bookings()->latest()->first();
                $origin = $origin ?? $lastBooking?->flight?->origin?->iata;
                $destination = $destination ?? $lastBooking?->flight?->destination?->iata;
            }

            // Fallback to popular routes if still missing
            if (!$origin || !$destination) {
                $popular = PopularRoute::orderBy('search_count', 'desc')->first();
                if ($popular) {
                    $origin = $origin ?? $popular->origin;
                    $destination = $destination ?? $popular->destination;
                }
            }

            // If still no personalization data, return empty collection
            if (!$origin || !$destination) {
                return collect(); // NO random flights for cold-start
            }

            /** -------------------------------------------------------
             *  ✈️ STEP 2 — Generate baseline local recommendations
             * ------------------------------------------------------- */
            $recommendations = $this->localRecommender
                ->recommend($origin, $destination, $limit * 2)
                ->map(fn($item) => [
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
                    $localScore = $flightItem['score'];
                    $llmScore = min(1, max(0, $rec['score']));

                    // Weighted scoring
                    $flightItem['score'] = ($localScore * 0.6) + ($llmScore * 0.4);

                    // Merge LLM reason
                    $flightItem['reason'] = $flightItem['reason']
                        ? $flightItem['reason'] . '; ' . strval($rec['reason'] ?? '')
                        : strval($rec['reason'] ?? '');

                    $byId[$flightId] = $flightItem;
                }

                $recommendations = collect($byId);
            }

            /** -------------------------------------------------------
             *  📦 STEP 4 — Filter and dynamically select cards
             * ------------------------------------------------------- */
            $sorted = $recommendations->sortByDesc('score');

            // Only keep flights with score > 0 or a reason
            $filtered = $sorted->filter(fn($item) => $item['score'] > 0 || !empty($item['reason']));

            // Ensure at least 1 recommendation if possible
            if ($filtered->isEmpty() && $sorted->isNotEmpty()) {
                $filtered = $sorted->take(1);
            }

            return $filtered->map(function ($item) {
                $flight = $item['flight'];
                if ($flight) {
                    $flight->score = $item['score'];
                    $flight->reason = trim((string) ($item['reason'] ?? ''));
                }
                return $flight;
            })->filter(); // remove null flights
        });
    }
}
