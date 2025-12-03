<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Airport;
use App\Models\User;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\Fare;
use Carbon\Carbon;

class BookingsSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {

            // Each user books 2–4 flights
            $numBookings = rand(2, 4);

            for ($i = 0; $i < $numBookings; $i++) {

                $flight = Flight::inRandomOrder()->first();
                $fare = Fare::where('flight_id', $flight->id)
                            ->inRandomOrder()
                            ->first();

                Booking::create([
                    'user_id' => $user->id,
                    'flight_id' => $flight->id,
                    'fare_id' => $fare->id,
                    'passengers' => rand(1, 3),
                    'total_price_cents' => $fare->price_cents * rand(1, 3),
                    'currency' => 'USD',
                    'status' => 'confirmed',
                    'booking_reference' => Booking::generateReference(),
                ]);
            }
        }
    }
}
