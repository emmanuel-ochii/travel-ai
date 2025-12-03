<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Fare;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UsersPersonaSeeder extends Seeder
{
    public function run(): void
    {
        $personas = ['budget', 'family', 'luxury', 'adventure'];

        $flights = Flight::all();

        foreach (User::all() as $user) {
            // Assign random persona
            $user->update([
                'persona' => $personas[array_rand($personas)],
            ]);

            // Generate 6 historical bookings
            for ($i = 0; $i < 6; $i++) {
                $flight = $flights->random();
                $fare   = $flight->fares->random();

                Booking::create([
                    'user_id' => $user->id,
                    'flight_id' => $flight->id,
                    'fare_id' => $fare->id,
                    'passengers' => rand(1, 4), // random passenger count
                    'total_price_cents' => $fare->price_cents * rand(1, 4),
                    'currency' => $fare->currency,
                    'status' => 'completed',
                    'booking_reference' => strtoupper(Str::random(8)),
                    'created_at' => Carbon::now()->subDays(rand(10, 100)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $this->command->info("All users now have a persona and 6 historical bookings each.");

    }
}
