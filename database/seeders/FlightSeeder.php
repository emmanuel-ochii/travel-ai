<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run()
    {
        $airlines = DB::table('airlines')->pluck('id')->toArray();
        $airports = DB::table('airports')->pluck('id')->toArray();

        $flights = [];

        $totalFlights = 60;

        for ($i = 0; $i < $totalFlights; $i++) {

            // Ensure different airports
            do {
                $origin = $airports[array_rand($airports)];
                $destination = $airports[array_rand($airports)];
            } while ($origin === $destination);

            // Date range: Dec 2025 → April 2026 (150 days)
            $depart = Carbon::create(2025, 12, 1)->addDays(rand(0, 150));

            // Random airline
            $airline_id = $airlines[array_rand($airlines)];

            // Duration
            $duration = rand(60, 720); // 1h → 12h
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
                'base_price_cents' => rand(30000, 180000),
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('flights')->insert($flights);
    }
}
