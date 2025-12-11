<?php

namespace App\Services\AI;

use App\Models\Flight;
use App\Models\PopularRoute;
use App\Models\UserInteraction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LocalRecommender
{
    protected int $userId;
    protected array $weights = [
        'match_origin' => 1.2,
        'match_destination' => 1.2,
        'popular_route' => 0.8,
        'past_interests' => 1.5,
        'fare_score' => 1.0,
    ];

    public function __construct(?int $userId = null)
    {
        $this->userId = $userId;
    }

    public function recommend(string $originIata, string $destinationIata, int $limit = 10): Collection
    {
        // Ensure we have user interaction history — per requirement: no user history -> no recommendations
        $userHistory = $this->getUserFlightHistory();
        if ($this->userId && $userHistory->isEmpty()) {
            return collect(); // strict cold-start: don't show recommendations
        }

     
        $flights = Flight::with(['fares', 'airline', 'origin', 'destination'])
            ->whereHas('origin', fn($q) => $q->where('iata', $originIata))
            ->whereHas('destination', fn($q) => $q->where('iata', $destinationIata))
            ->get();




        $popularRoutes = Cache::get('popular_routes', collect());

        $scored = $flights->map(function ($flight) use ($originIata, $destinationIata, $popularRoutes, $userHistory) {
            $scoreDetails = $this->scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, $userHistory);

            return [
                'flight' => $flight,
                'score' => $scoreDetails['score'],
                'reason' => $scoreDetails['reason'],
            ];
        });

        // Remove flights with no meaningful score or reason
        return $scored
            ->filter(fn($item) => $item['score'] > 0 || !empty($item['reason']))
            ->sortByDesc('score')
            ->take($limit)
            ->values();
    }


    /**
     * Calculate flight score and generate a dynamic reason string.
     */
    protected function scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, Collection $userHistory): array
    {
        $score = 0.0;
        $reasons = [];

        // Origin match
        if (!empty($originIata) && $flight->origin->iata === $originIata) {
            $score += $this->weights['match_origin'];
            $reasons[] = "Matches your departure city";
        }

        // Destination match
        if (!empty($destinationIata) && $flight->destination->iata === $destinationIata) {
            $score += $this->weights['match_destination'];
            $reasons[] = "Matches your arrival city";
        }

        // Popular route
        $popularity = $popularRoutes->firstWhere(
            fn($pr) =>
            ($pr->origin ?? null) === $flight->origin->iata && ($pr->destination ?? null) === $flight->destination->iata
        );

        if ($popularity) {
            $popScore = $this->weights['popular_route'] * min(($popularity->search_count ?? 0) / 50, 1);
            $score += $popScore;
            if ($popScore > 0) {
                $reasons[] = "Popular route";
            }
        }

        // Past interactions: check if userHistory contains this flight id
        if ($this->userId && $userHistory->contains($flight->id)) {
            $score += $this->weights['past_interests'];
            $reasons[] = "Based on your past interactions";
        }

        // Fare score (cheaper is better)
        $cheapest = $flight->fares->min('price_cents') ?? 99999999;
        // normalize around $2000 (200000 cents)
        $normalizedPrice = max(0, 1 - ($cheapest / 200000));
        $fareScore = $normalizedPrice * $this->weights['fare_score'];
        $score += $fareScore;
        if ($fareScore > 0) {
            $reasons[] = "Affordable fare";
        }

        // Keep as a float with two decimals
        return [
            'score' => round($score, 2),
            'reason' => implode('; ', $reasons),
        ];
    }

    /**
     * Retrieve user flight interaction history as a collection of flight IDs.
     */
    protected function getUserFlightHistory(): Collection
    {
        if (!$this->userId) {
            return collect();
        }

        return Cache::remember("user_history_{$this->userId}", now()->addHours(6), function () {
            // We only need flight ids from payloads for personalization checks.
            $interactions = UserInteraction::where('user_id', $this->userId)
                ->whereIn('type', ['search', 'view', 'select_fare', 'book', 'feedback', 'like', 'abandon'])
                ->orderBy('created_at', 'desc')
                ->get();

            $flightIds = collect();

            foreach ($interactions as $i) {
                // payload could be JSON string or array
                $payload = $i->payload;
                if (is_string($payload)) {
                    $decoded = json_decode($payload, true);
                } else {
                    $decoded = $payload;
                }

                if (is_array($decoded)) {
                    // many payload shapes may have flight_id or nested flight id
                    if (isset($decoded['flight_id'])) {
                        $flightIds->push($decoded['flight_id']);
                    } else {
                        // attempt to find any flight_id in nested arrays
                        array_walk_recursive($decoded, function ($v, $k) use ($flightIds) {
                            if ($k === 'flight_id' && is_scalar($v)) {
                                $flightIds->push($v);
                            }
                        });
                    }
                }
            }

            return $flightIds->unique()->values();
        });
    }
}
