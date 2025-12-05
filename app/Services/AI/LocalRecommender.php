<?php

namespace App\Services\AI;

use App\Models\Flight;
use App\Models\UserInteraction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LocalRecommender
{
    protected array $weights = [
        'match_origin' => 40,
        'match_destination' => 40,
        'popular_route' => 20,
        'past_interests' => 30,
        'fare_score' => 25,
    ];

    protected ?int $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    /**
     * Recommend flights based on scoring.
     */
    public function recommend(string $originIata, string $destinationIata, int $limit = 10): Collection
    {
        $flights = Flight::with(['fares', 'airline', 'origin', 'destination'])->get();
        $popularRoutes = Cache::get('popular_routes', collect());
        $userHistory = $this->getUserFlightHistory();

        $scored = $flights->map(function ($flight) use ($originIata, $destinationIata, $popularRoutes, $userHistory) {
            $scoreDetails = $this->scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, $userHistory);
            return [
                'flight' => $flight,
                'score' => $scoreDetails['score'],
                'reason' => $scoreDetails['reason'],
            ];
        });

        // Remove flights with no meaningful score or reason
        return $scored->filter(fn($item) => $item['score'] > 0 || !empty($item['reason']))
            ->sortByDesc('score')
            ->take($limit);
    }

    /**
     * Calculate flight score and generate a dynamic reason string.
     */
    protected function scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, $userHistory): array
    {
        $score = 0;
        $reasons = [];

        // Origin match
        if ($flight->origin->iata === $originIata) {
            $score += $this->weights['match_origin'];
            $reasons[] = "Matches your departure city";
        }

        // Destination match
        if ($flight->destination->iata === $destinationIata) {
            $score += $this->weights['match_destination'];
            $reasons[] = "Matches your arrival city";
        }

        // Popular route
        $popularity = $popularRoutes->firstWhere(
            fn($pr) =>
            $pr->origin === $flight->origin->iata && $pr->destination === $flight->destination->iata
        );
        if ($popularity) {
            $popScore = $this->weights['popular_route'] * min($popularity->search_count / 50, 1);
            $score += $popScore;
            if ($popScore > 0)
                $reasons[] = "Popular route";
        }

        // Past interactions: views, clicks, likes, abandoned bookings
        if ($this->userId && $userHistory->isNotEmpty()) {
            if ($userHistory->contains('flight_id', $flight->id)) {
                $score += $this->weights['past_interests'];
                $reasons[] = "Based on your past interactions";
            }
        }

        // Fare score (cheaper is better)
        $cheapest = $flight->fares->min('price_cents') ?? 99999999;
        $normalizedPrice = max(0, 1 - ($cheapest / 200000)); // normalize ~2000 USD threshold
        $fareScore = $normalizedPrice * $this->weights['fare_score'];
        $score += $fareScore;
        if ($fareScore > 0)
            $reasons[] = "Affordable fare";

        return [
            'score' => (int) $score,
            'reason' => implode('; ', $reasons),
        ];
    }

    /**
     * Retrieve user flight interaction history.
     */
    protected function getUserFlightHistory(): Collection
    {
        if (!$this->userId)
            return collect();

        return Cache::remember("user_history_{$this->userId}", now()->addHours(6), function () {
            return UserInteraction::where('user_id', $this->userId)
                ->whereIn('type', ['search', 'view', 'select_fare', 'book', 'feedback', 'like', 'abandon'])
                ->get()
                ->pluck('payload')
                ->flatten(1); // Flatten for easy flight_id access
        });
    }
}
