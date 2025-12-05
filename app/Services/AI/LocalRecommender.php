<?php

namespace App\Services\AI;

use App\Models\Flight;
use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

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

    public function recommend(string $originIata, string $destinationIata, int $limit = 10): Collection
    {
        $flights = Flight::with(['fares', 'airline', 'origin', 'destination'])->get();

        $popularRoutes = Cache::get('popular_routes', collect());
        $userHistory = $this->getUserFlightHistory();

        $scored = $flights->map(function ($flight) use ($originIata, $destinationIata, $popularRoutes, $userHistory) {
            return [
                'flight' => $flight,
                'score' => $this->scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, $userHistory),
            ];
        });

        return $scored->sortByDesc('score')->take($limit);
    }

    protected function scoreFlight($flight, $originIata, $destinationIata, $popularRoutes, $userHistory): int
    {
        $score = 0;

        // Match origin
        if ($flight->origin->iata === $originIata) {
            $score += $this->weights['match_origin'];
        }

        // Match destination
        if ($flight->destination->iata === $destinationIata) {
            $score += $this->weights['match_destination'];
        }

        // Popularity
        $popularity = $popularRoutes->firstWhere(
            fn($pr) =>
            $pr->origin === $flight->origin->iata && $pr->destination === $flight->destination->iata
        );

        if ($popularity) {
            $score += $this->weights['popular_route'] * min($popularity->search_count / 50, 1);
        }

        // Past interactions
        if ($this->userId && $userHistory->isNotEmpty()) {
            if ($userHistory->contains('airline_id', $flight->airline_id)) {
                $score += $this->weights['past_interests'];
            }
        }

        // Fare score (cheaper is better)
        $cheapest = $flight->fares->min('price_cents') ?? 99999999;
        $normalizedPrice = max(0, 1 - ($cheapest / 200000)); // normalize threshold ~$2000
        $score += $normalizedPrice * $this->weights['fare_score'];

        return (int) $score;
    }

    protected function getUserFlightHistory(): Collection
    {
        if (!$this->userId) {
            return collect();
        }

        return Cache::remember("user_history_{$this->userId}", now()->addHours(6), function () {
            return UserInteraction::where('user_id', $this->userId)
                ->whereIn('type', ['feedback', 'booking', 'search'])
                ->get()
                ->pluck('payload')
                ->collect();
        });
    }
}
