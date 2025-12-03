<?php

namespace App\Services;

use App\Models\User;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Fare;
use Carbon\Carbon;

class TravelRecommendationService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getRecommendations(int $limit = 5)
    {
        $bookings = Booking::where('user_id', $this->user->id)->get();

        $preferredAirports = $bookings->pluck('flight.destination_airport_id')->toArray();
        $preferredAirlines = $bookings->pluck('flight.airline_id')->toArray();

        $persona = $this->user->persona;

        $flights = Flight::with('fares', 'airline', 'origin', 'destination')
            ->whereDate('depart_at', '>=', Carbon::now())
            ->get()
            ->map(function ($flight) use ($preferredAirports, $preferredAirlines, $persona) {
                $score = 0;
                $reasons = [];

                // 1️⃣ Destination preference
                if (in_array($flight->destination_airport_id, $preferredAirports)) {
                    $score += 50;
                    $reasons[] = 'Matches your previous destinations';
                }

                // 2️⃣ Preferred airline
                if (in_array($flight->airline_id, $preferredAirlines)) {
                    $score += 30;
                    $reasons[] = 'Preferred airline based on your history';
                }

                // 3️⃣ Persona-based scoring
                $lowestFare = $flight->fares->sortBy('price_cents')->first();
                if ($lowestFare) {
                    switch ($persona) {
                        case 'budget':
                            $score += max(0, 20 - ($lowestFare->price_cents / 1000));
                            if ($lowestFare->price_cents / 100 < 500) {
                                $reasons[] = 'Affordable fare for your budget persona';
                            }
                            break;
                        case 'luxury':
                            $score += ($lowestFare->price_cents / 100) / 100; // higher fare = higher score
                            $reasons[] = 'Premium fare matches your luxury persona';
                            break;
                        case 'family':
                            $score += 15; // generic bonus for family-friendly
                            $reasons[] = 'Family-friendly option';
                            break;
                        default:
                            $score += 10;
                            break;
                    }
                }

                // 4️⃣ Seasonal boost (optional: flights departing within popular months)
                $month = $flight->depart_at->month;
                if (in_array($month, [12, 1, 7, 8])) { // holiday/summer boost
                    $score += 10;
                    $reasons[] = 'Popular travel season';
                }

                $flight->score = $score;
                $flight->reason = implode(', ', $reasons);
                return $flight;
            })
            ->sortByDesc('score')
            ->take($limit);

        return $flights;
    }
}
