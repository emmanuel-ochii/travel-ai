<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $flights = DB::table('flights')->pluck('id')->toArray();
        $fares = [];

        foreach ($flights as $flight_id) {
            // Economy
            $fares[] = [
                'flight_id' => $flight_id,
                'fare_class' => 'economy',
                'price_cents' => rand(20000, 80000),
                'currency' => 'USD',
                'refundable' => false,
                'baggage_allowance' => '1 bag',
                'rules_json' => json_encode(['changeable' => false, 'cancelable' => false]),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Business
            $fares[] = [
                'flight_id' => $flight_id,
                'fare_class' => 'business',
                'price_cents' => rand(90000, 150000),
                'currency' => 'USD',
                'refundable' => true,
                'baggage_allowance' => '2 bags',
                'rules_json' => json_encode(['changeable' => true, 'cancelable' => true]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('fares')->insert($fares);
    }
}
