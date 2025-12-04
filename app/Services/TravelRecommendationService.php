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

    // This is the previous working recommendation purely based on local scoring rules
    // public function getRecommendations(int $limit = 5)
    // {
    //     $bookings = Booking::where('user_id', $this->user->id)->get();

    //     $preferredAirports = $bookings->pluck('flight.destination_airport_id')->toArray();
    //     $preferredAirlines = $bookings->pluck('flight.airline_id')->toArray();

    //     $persona = $this->user->persona;

    //     $flights = Flight::with('fares', 'airline', 'origin', 'destination')
    //         ->whereDate('depart_at', '>=', Carbon::now())
    //         ->get()
    //         ->map(function ($flight) use ($preferredAirports, $preferredAirlines, $persona) {
    //             $score = 0;
    //             $reasons = [];

    //             // 1️⃣ Destination preference
    //             if (in_array($flight->destination_airport_id, $preferredAirports)) {
    //                 $score += 50;
    //                 $reasons[] = 'Matches your previous destinations';
    //             }

    //             // 2️⃣ Preferred airline
    //             if (in_array($flight->airline_id, $preferredAirlines)) {
    //                 $score += 30;
    //                 $reasons[] = 'Preferred airline based on your history';
    //             }

    //             // 3️⃣ Persona-based scoring
    //             $lowestFare = $flight->fares->sortBy('price_cents')->first();
    //             if ($lowestFare) {
    //                 switch ($persona) {
    //                     case 'budget':
    //                         $score += max(0, 20 - ($lowestFare->price_cents / 1000));
    //                         if ($lowestFare->price_cents / 100 < 500) {
    //                             $reasons[] = 'Affordable fare for your budget persona';
    //                         }
    //                         break;
    //                     case 'luxury':
    //                         $score += ($lowestFare->price_cents / 100) / 100; // higher fare = higher score
    //                         $reasons[] = 'Premium fare matches your luxury persona';
    //                         break;
    //                     case 'family':
    //                         $score += 15; // generic bonus for family-friendly
    //                         $reasons[] = 'Family-friendly option';
    //                         break;
    //                     default:
    //                         $score += 10;
    //                         break;
    //                 }
    //             }

    //             // 4️⃣ Seasonal boost (optional: flights departing within popular months)
    //             $month = $flight->depart_at->month;
    //             if (in_array($month, [12, 1, 7, 8])) { // holiday/summer boost
    //                 $score += 10;
    //                 $reasons[] = 'Popular travel season';
    //             }

    //             $flight->score = $score;
    //             $flight->reason = implode(', ', $reasons);
    //             return $flight;
    //         })
    //         ->sortByDesc('score')
    //         ->take($limit);

    //     return $flights;
    // }

    // SUGGESTION 1
    // public function getRecommendations(int $limit = 5, bool $useLlm = false)
    // {
    //     // Local scoring logic
    //     $bookings = Booking::where('user_id', $this->user->id)->get();

    //     $preferredAirports = $bookings->pluck('flight.destination_airport_id')->toArray();
    //     $preferredAirlines = $bookings->pluck('flight.airline_id')->toArray();
    //     $persona = $this->user->persona;

    //     $local = Flight::with('fares', 'airline', 'origin', 'destination')
    //         ->whereDate('depart_at', '>=', Carbon::now())
    //         ->get()
    //         ->map(function ($flight) use ($preferredAirports, $preferredAirlines, $persona) {
    //             $score = 0;
    //             $reasons = [];

    //             // 1️⃣ Destination preference
    //             if (in_array($flight->destination_airport_id, $preferredAirports)) {
    //                 $score += 50;
    //                 $reasons[] = 'Matches your previous destinations';
    //             }

    //             // 2️⃣ Preferred airline
    //             if (in_array($flight->airline_id, $preferredAirlines)) {
    //                 $score += 30;
    //                 $reasons[] = 'Preferred airline based on your history';
    //             }

    //             // 3️⃣ Persona-based scoring
    //             $lowestFare = $flight->fares->sortBy('price_cents')->first();
    //             if ($lowestFare) {
    //                 switch ($persona) {
    //                     case 'budget':
    //                         $score += max(0, 20 - ($lowestFare->price_cents / 1000));
    //                         if ($lowestFare->price_cents / 100 < 500) {
    //                             $reasons[] = 'Affordable fare for your budget persona';
    //                         }
    //                         break;
    //                     case 'luxury':
    //                         $score += ($lowestFare->price_cents / 100) / 100; // higher fare = higher score
    //                         $reasons[] = 'Premium fare matches your luxury persona';
    //                         break;
    //                     case 'family':
    //                         $score += 15;
    //                         $reasons[] = 'Family-friendly option';
    //                         break;
    //                     default:
    //                         $score += 10;
    //                         break;
    //                 }
    //             }

    //             // 4️⃣ Seasonal boost
    //             $month = $flight->depart_at->month;
    //             if (in_array($month, [12, 1, 7, 8])) {
    //                 $score += 10;
    //                 $reasons[] = 'Popular travel season';
    //             }

    //             $flight->score = $score;
    //             $flight->reason = implode(', ', $reasons);
    //             return $flight;
    //         })
    //         ->sortByDesc('score')
    //         ->take($limit * 2); // take extra for LLM candidates

    //     // LLM integration
    //     if ($useLlm) {
    //         // Prepare lightweight candidate list
    //         $candidates = $local->map(function ($f) {
    //             return [
    //                 'id' => $f->id,
    //                 'origin' => $f->origin->iata,
    //                 'destination' => $f->destination->iata,
    //                 'depart_at' => $f->depart_at->toIso8601String(),
    //                 'price' => optional($f->fares->sortBy('price_cents')->first())->price_cents / 100,
    //             ];
    //         })->values()->all();

    //         $context = [
    //             'persona' => $this->user->persona,
    //             'recent_bookings' => Booking::where('user_id', $this->user->id)
    //                 ->latest()
    //                 ->take(8)
    //                 ->get()
    //                 ->toArray(),
    //             'candidates' => $candidates,
    //         ];

    //         $llm = app(\App\Services\LLMService::class);
    //         $llmRecommendations = $llm->getRecommendations($context);

    //         // Merge LLM scores with local scores
    //         $byId = $local->keyBy('id');
    //         foreach ($llmRecommendations as $rec) {
    //             if (!isset($byId[$rec['flight_id']]))
    //                 continue;

    //             // Weighted merge: adjust 0.6 / 40 as needed
    //             $byId[$rec['flight_id']]->score = $byId[$rec['flight_id']]->score * 0.6 + ($rec['score'] * 40);

    //             // Append LLM reason
    //             $byId[$rec['flight_id']]->reason .= ($byId[$rec['flight_id']]->reason ? '; ' : '') . ($rec['reason'] ?? '');
    //         }

    //         return $byId->sortByDesc('score')->values()->take($limit);
    //     }

    //     return $local->take($limit);
    // }

    public function getRecommendations(int $limit = 5, bool $useLlm = false)
    {
        $bookings = Booking::where('user_id', $this->user->id)->get();

        $preferredAirports = $bookings->pluck('flight.destination_airport_id')->toArray();
        $preferredAirlines = $bookings->pluck('flight.airline_id')->toArray();
        $persona = $this->user->persona;

        // ----------------------
        // 1️⃣ Local scoring
        // ----------------------
        $local = Flight::with('fares', 'airline', 'origin', 'destination')
            ->whereDate('depart_at', '>=', Carbon::now())
            ->get()
            ->map(function ($flight) use ($preferredAirports, $preferredAirlines, $persona) {
                $score = 0;
                $reasons = [];

                // Destination preference
                if (in_array($flight->destination_airport_id, $preferredAirports)) {
                    $score += 0.5; // normalized 0–1
                    $reasons[] = 'Matches your previous destinations';
                }

                // Preferred airline
                if (in_array($flight->airline_id, $preferredAirlines)) {
                    $score += 0.3;
                    $reasons[] = 'Preferred airline based on your history';
                }

                // Persona-based scoring
                $lowestFare = $flight->fares->sortBy('price_cents')->first();
                if ($lowestFare) {
                    switch ($persona) {
                        case 'budget':
                            $fareScore = max(0, 0.2 - ($lowestFare->price_cents / 100000)); // 0–0.2
                            $score += $fareScore;
                            if ($lowestFare->price_cents / 100 < 500) {
                                $reasons[] = 'Affordable fare for your budget persona';
                            }
                            break;

                        case 'luxury':
                            $score += min(0.2, ($lowestFare->price_cents / 100000)); // cap to 0.2
                            $reasons[] = 'Premium fare matches your luxury persona';
                            break;

                        case 'family':
                            $score += 0.15;
                            $reasons[] = 'Family-friendly option';
                            break;

                        default:
                            $score += 0.1;
                            break;
                    }
                }

                // Seasonal boost
                $month = $flight->depart_at->month;
                if (in_array($month, [12, 1, 7, 8])) {
                    $score += 0.1;
                    $reasons[] = 'Popular travel season';
                }

                $flight->score = min(1, $score); // ensure max 1
                $flight->reason = implode(', ', $reasons);

                return $flight;
            })
            ->sortByDesc('score')
            ->take($limit * 2); // extra for LLM candidates if used

        // ----------------------
        // 2️⃣ LLM integration
        // ----------------------
        if ($useLlm && $local->isNotEmpty()) {
            $candidates = $local->map(function ($f) {
                return [
                    'id' => $f->id,
                    'origin' => $f->origin->iata,
                    'destination' => $f->destination->iata,
                    'depart_at' => $f->depart_at->toIso8601String(),
                    'price' => optional($f->fares->sortBy('price_cents')->first())->price_cents / 100,
                ];
            })->values()->all();

            $context = [
                'persona' => $this->user->persona,
                'recent_bookings' => Booking::where('user_id', $this->user->id)->latest()->take(8)->get()->toArray(),
                'candidates' => $candidates,
            ];

            $llm = app(\App\Services\LLMService::class);
            $llmRecommendations = $llm->getRecommendations($context);

            $byId = $local->keyBy('id');

            foreach ($llmRecommendations as $rec) {
                if (!isset($byId[$rec['flight_id']]))
                    continue;

                // Normalize LLM score to 0–1
                $llmScore = min(1, max(0, $rec['score']));

                // Blend local and LLM scores
                $byId[$rec['flight_id']]->score = ($byId[$rec['flight_id']]->score * 0.6) + ($llmScore * 0.4);

                $byId[$rec['flight_id']]->reason .= ($byId[$rec['flight_id']]->reason ? '; ' : '') . ($rec['reason'] ?? '');
            }

            return $byId->sortByDesc('score')->values()->take($limit);
        }

        return $local->take($limit);
    }
}
