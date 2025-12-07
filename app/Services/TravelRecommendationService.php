<?php

namespace App\Services;

use App\Models\PopularRoute;
use App\Services\AI\LocalRecommender;
use App\Services\AI\GroqLLMService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TravelRecommendationService
{
    protected $user;
    protected LocalRecommender $localRecommender;

    public function __construct($user)
    {
        $this->user = $user;
        $this->localRecommender = new LocalRecommender($user->id ?? null);
    }


    // public function getRecommendations(int $limit = 5, bool $useLlm = false): Collection
    // {
    //     $cacheKey = "user_{$this->user->id}_recommendations_" . ($useLlm ? 'llm' : 'local') . "_limit{$limit}";

    //     return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($limit, $useLlm) {

    //         /** ------------------------------------------------------
    //          *  🧠 STEP 1 — Determine personalization source
    //          * ------------------------------------------------------- */
    //         $signals = \App\Services\UserPreferenceAnalyzer::getUserSignals();

    //         // Safely handle top_route (format "ORIGIN-DEST")
    //         $topRoute = $signals['top_route'] ?? null;
    //         if ($topRoute) {
    //             [$origin, $destination] = explode('-', $topRoute);
    //         } else {
    //             $origin = $destination = null;
    //         }

    //         // Fallback to last booking if no top_route
    //         if (!$origin || !$destination) {
    //             $lastBooking = $this->user->bookings()->latest()->first();
    //             $origin = $origin ?? $lastBooking?->flight?->origin?->iata;
    //             $destination = $destination ?? $lastBooking?->flight?->destination?->iata;
    //         }

    //         // Fallback to popular routes if still missing
    //         if (!$origin || !$destination) {
    //             $popular = PopularRoute::orderBy('search_count', 'desc')->first();
    //             if ($popular) {
    //                 $origin = $origin ?? $popular->origin;
    //                 $destination = $destination ?? $popular->destination;
    //             }
    //         }

    //         // If still no personalization data, return empty collection (strict cold-start)
    //         if (!$origin || !$destination) {
    //             return collect(); // NO random flights for cold-start
    //         }

    //         /** ------------------------------------------------------
    //          *  ✈️ STEP 2 — Generate baseline local recommendations
    //          * ------------------------------------------------------- */
    //         $recommendations = $this->localRecommender
    //             ->recommend($origin, $destination, $limit * 2)
    //             ->map(fn($item) => [
    //                 'flight' => is_array($item) && isset($item['flight']) ? $item['flight'] : $item,
    //                 'score' => $item['score'] ?? 0,
    //                 'reason' => strval($item['reason'] ?? ''),
    //             ]);

    //         /** ------------------------------------------------------
    //          *  🤖 STEP 3 — Apply LLM intelligence (optional)
    //          * ------------------------------------------------------- */
    //         if ($useLlm && $recommendations->isNotEmpty() && config('services.groq.key')) {

    //             $context = [
    //                 'persona' => $this->user->persona,
    //                 'recent_bookings' => $this->user->bookings()->latest()->take(8)->get()->toArray(),
    //                 'signals' => $signals,
    //                 'candidates' => $recommendations->map(fn($f) => [
    //                     'id' => $f['flight']->id ?? null,
    //                     'origin' => $f['flight']->origin?->iata ?? null,
    //                     'destination' => $f['flight']->destination?->iata ?? null,
    //                     'depart_at' => $f['flight']->depart_at?->toIso8601String() ?? null,
    //                     'price' => optional($f['flight']->fares->sortBy('price_cents')->first())->price_cents / 100 ?? null,
    //                 ])->values()->all(),
    //             ];

    //             $llm = app(GroqLLMService::class);
    //             try {
    //                 $llmRecommendations = $llm->getRecommendations($context);
    //             } catch (\Exception $e) {
    //                 logger()->error("Groq LLM failed: " . $e->getMessage());
    //                 $llmRecommendations = [];
    //             }

    //             // Map existing recommendations by flight id for easy lookup
    //             $byId = $recommendations->keyBy(fn($f) => $f['flight']->id ?? null);

    //             foreach ($llmRecommendations as $rec) {
    //                 $flightId = $rec['flight_id'] ?? null;
    //                 if (!$flightId || !isset($byId[$flightId])) {
    //                     continue;
    //                 }

    //                 $flightItem = $byId[$flightId];
    //                 $localScore = floatval($flightItem['score']);
    //                 $llmScore = min(1, max(0, floatval($rec['score'] ?? 0)));

    //                 // Weighted scoring (you can tune weights here)
    //                 $combinedScore = ($localScore * 0.6) + ($llmScore * 0.4);

    //                 // OVERWRITE reason with LLM reason — do not merge, per requirement
    //                 $flightItem['score'] = round($combinedScore, 2);
    //                 $flightItem['reason'] = strval($rec['reason'] ?? '');

    //                 // mark that this flight was influenced by LLM
    //                 $flightItem['llm_influenced'] = true;

    //                 $byId[$flightId] = $flightItem;
    //             }

    //             $recommendations = collect($byId)->values();
    //         }

    //         /** ------------------------------------------------------
    //          *  📦 STEP 4 — Filter and dynamically select cards
    //          * ------------------------------------------------------- */
    //         $sorted = $recommendations->sortByDesc('score');

    //         // Only keep flights with score > 0 or a reason
    //         $filtered = $sorted->filter(fn($item) => $item['score'] > 0 || !empty($item['reason']));

    //         // Ensure at least 1 recommendation if possible
    //         if ($filtered->isEmpty() && $sorted->isNotEmpty()) {
    //             $filtered = $sorted->take(1);
    //         }

    //         // Attach score/reason to flight models and add llm flag (false if not present)
    //         return $filtered->map(function ($item) {
    //             /** @var \App\Models\Flight $flight */
    //             $flight = $item['flight'];
    //             if ($flight) {
    //                 $flight->score = $item['score'] ?? 0;
    //                 $flight->reason = trim((string) ($item['reason'] ?? ''));
    //                 $flight->llm_influenced = !empty($item['llm_influenced']);
    //             }
    //             return $flight;
    //         })->filter(); // remove null flights
    //     });
    // }

    public function getRecommendations(int $limit = 5, bool $useLlm = false): Collection
    {
        $cacheKey = "user_{$this->user->id}_recommendations_" . ($useLlm ? 'llm' : 'local') . "_limit{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($limit, $useLlm) {

            /** ------------------------------------------------------
             *  STEP 1 — Determine personalization route (origin + destination)
             * ------------------------------------------------------- */
            $signals = \App\Services\UserPreferenceAnalyzer::getUserSignals();

            $topRoute = $signals['top_route'] ?? null;
            if ($topRoute) {
                [$origin, $destination] = explode('-', $topRoute);
            } else {
                $origin = $destination = null;
            }

            if (!$origin || !$destination) {
                $lastBooking = $this->user->bookings()->latest()->first();
                $origin = $origin ?? $lastBooking?->flight?->origin?->iata;
                $destination = $destination ?? $lastBooking?->flight?->destination?->iata;
            }

            if (!$origin || !$destination) {
                $popular = PopularRoute::orderBy('search_count', 'desc')->first();
                if ($popular) {
                    $origin = $origin ?? $popular->origin;
                    $destination = $destination ?? $popular->destination;
                }
            }

            if (!$origin || !$destination) {
                return collect();
            }

            /** ------------------------------------------------------
             *  STEP 2 — Get baseline local recommendations
             * ------------------------------------------------------- */
            $recommendations = $this->localRecommender
                ->recommend($origin, $destination, $limit * 2)
                ->map(fn($item) => [
                    'flight' => is_array($item) && isset($item['flight']) ? $item['flight'] : $item,
                    'score' => $item['score'] ?? 0,
                    'reason' => strval($item['reason'] ?? ''),
                ]);

            /** ------------------------------------------------------
             *  STEP 3 — LLM Enhancements (Optional)
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
                    $localScore = floatval($flightItem['score']);
                    $llmScore = min(1, max(0, floatval($rec['score'] ?? 0)));

                    $flightItem['score'] = round(($localScore * 0.6) + ($llmScore * 0.4), 2);
                    $flightItem['reason'] = strval($rec['reason'] ?? '');
                    $flightItem['llm_influenced'] = true;

                    $byId[$flightId] = $flightItem;
                }

                $recommendations = collect($byId)->values();
            }

            /** ------------------------------------------------------
             *  🔥 STEP 4 — Route Filtering (Your Requested Fix)
             * ------------------------------------------------------- */
            $recommendations = $recommendations->filter(function ($item) use ($origin, $destination) {
                return ($item['flight']->origin->iata === $origin) &&
                    ($item['flight']->destination->iata === $destination);
            });

            /** ------------------------------------------------------
             *  STEP 5 — Sort & Output
             * ------------------------------------------------------- */
            $sorted = $recommendations->sortByDesc('score');

            if ($sorted->isEmpty())
                return collect();

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
