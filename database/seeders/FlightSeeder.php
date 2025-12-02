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
        $routes = [];

        while (count($flights) < 60) { // Ensure exactly 60 flights
            // Pick two different airports
            do {
                $origin = $airports[array_rand($airports)];
                $destination = $airports[array_rand($airports)];
            } while ($origin === $destination);

            $routeKey = $origin . '-' . $destination;
            $airline_id = $airlines[array_rand($airlines)];

            // Random date between Dec 2025 and Mar 2026
            $depart = Carbon::create(rand(2025, 2026), rand(12, 3), rand(1, 28), rand(0, 23), rand(0, 59), 0);
            if ($depart->month > 3) $depart->month = 3;

            // Limit 2–3 flights per route per day
            if (isset($routes[$routeKey][$depart->toDateString()]) && count($routes[$routeKey][$depart->toDateString()]) >= 3) {
                continue;
            }

            $duration = rand(60, 720);
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

            // Track flights per route per day
            $routes[$routeKey][$depart->toDateString()][] = $airline_id;
        }

        DB::table('flights')->insert($flights);
    }
}
