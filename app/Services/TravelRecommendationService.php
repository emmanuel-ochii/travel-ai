<?php

namespace App\Services;

use App\Models\User;
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
     * Get travel recommendations
     *
     * @param int $limit
     * @param bool $useLlm
     * @return Collection
     */

    public function getRecommendations(int $limit = 5, bool $useLlm = false): Collection
    {
        $cacheKey = "user_{$this->user->id}_recommendations_" . ($useLlm ? 'llm' : 'local') . "_limit{$limit}";

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($limit, $useLlm) {

            // 1️⃣ Determine origin/destination based on last booking
            $lastBooking = $this->user->bookings()->latest()->first();
            $origin = optional($lastBooking->flight->origin)->iata ?? '';
            $destination = optional($lastBooking->flight->destination)->iata ?? '';

            // 2️⃣ Base recommendations from LocalRecommender
            $recommendations = $this->localRecommender
                ->recommend($origin, $destination, $limit * 2);

            $recommendations = $recommendations->map(fn($item) => [
                'flight' => is_array($item) && isset($item['flight']) ? $item['flight'] : $item,
                'score' => $item['score'] ?? 0,
                'reason' => $item['reason'] ?? '',
            ]);

            // 3️⃣ Optional: LLM integration (only if endpoint is configured)
            if ($useLlm && $recommendations->isNotEmpty() && config('services.llm.endpoint')) {

                $context = [
                    'persona' => $this->user->persona,
                    'recent_bookings' => $this->user->bookings()->latest()->take(8)->get()->toArray(),
                    'candidates' => $recommendations->map(fn($f) => [
                        'id' => $f['flight']->id,
                        'origin' => $f['flight']->origin->iata,
                        'destination' => $f['flight']->destination->iata,
                        'depart_at' => $f['flight']->depart_at->toIso8601String(),
                        'price' => optional($f['flight']->fares->sortBy('price_cents')->first())->price_cents / 100,
                    ])->values()->all(),
                ];

                $llm = app(\App\Services\LLMService::class);

                try {
                    $llmRecommendations = $llm->getRecommendations($context);
                } catch (\Exception $e) {
                    // Fail silently, fallback to local recommendations
                    $llmRecommendations = [];
                }

                $byId = $recommendations->keyBy(fn($f) => $f['flight']->id);

                foreach ($llmRecommendations as $rec) {
                    if (!isset($byId[$rec['flight_id']]))
                        continue;

                    $flightItem = $byId[$rec['flight_id']];
                    $localScore = $flightItem['score'];
                    $llmScore = min(1, max(0, $rec['score']));

                    $flightItem['score'] = ($localScore * 0.6) + ($llmScore * 0.4);
                    $flightItem['reason'] .= ($flightItem['reason'] ? '; ' : '') . ($rec['reason'] ?? '');

                    $byId[$rec['flight_id']] = $flightItem;
                }

                $recommendations = collect($byId);
            }

            // 4️⃣ Return Flight models only, keeping score & reason as properties
            return $recommendations
                ->sortByDesc('score')
                ->take($limit)
                ->map(function ($item) {
                    $flight = $item['flight'];
                    $flight->score = $item['score'];
                    $flight->reason = $item['reason'];
                    return $flight;
                });
        });
    }

}
