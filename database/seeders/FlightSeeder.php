<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
        $airlines = DB::table('airlines')->pluck('id')->toArray();
        $airports = DB::table('airports')->pluck('id')->toArray();

        $flights = [];

        $totalFlights = 60;
        $currentCount = 0;

        while ($currentCount < $totalFlights) {
            // Pick two different airports
            do {
                $origin = $airports[array_rand($airports)];
                $destination = $airports[array_rand($airports)];
            } while ($origin === $destination);

            // Random date between Dec 2025 and Mar 2026
            $date = Carbon::create(rand(2025, 2026), rand(12, 3), rand(1, 28), 8, 0, 0);
            if ($date->month > 3) $date->month = 3;

            // Random number of flights for this route/day (2 or 3)
            $numFlightsForRoute = rand(2, min(3, count($airlines)));

            // Shuffle airlines so each flight can have a different airline
            $shuffledAirlines = $airlines;
            shuffle($shuffledAirlines);

            for ($i = 0; $i < $numFlightsForRoute && $currentCount < $totalFlights; $i++) {
                $airline_id = $shuffledAirlines[$i];

                // Random departure time within the day
                $depart = $date->copy()->addHours(rand(0, 10))->addMinutes(rand(0, 59));
                $duration = rand(60, 720); // 1h to 12h
                $arrive = $depart->copy()->addMinutes($duration);

                $flights[] = [
                    'airline_id' => $airline_id,
                    'flight_number' => strtoupper(Str::random(2)) . rand(100, 999),
                    'origin_airport_id' => $origin,
                    'destination_airport_id' => $destination,
                    'depart_at' => $depart,
                    'arrive_at' => $arrive,
                    'duration_minutes' => $duration,
                    'stops' => rand(0, 1),
                    'base_price_cents' => rand(20000, 150000),
                    'currency' => 'USD',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $currentCount++;
            }
        }

        DB::table('flights')->insert($flights);
    }
}
