<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('airports')->insert([
            ['iata' => 'JFK', 'icao' => 'KJFK', 'name' => 'John F. Kennedy International Airport', 'city' => 'New York', 'country' => 'USA', 'timezone' => 'America/New_York', 'created_at' => now(), 'updated_at' => now()],
            ['iata' => 'LHR', 'icao' => 'EGLL', 'name' => 'London Heathrow Airport', 'city' => 'London', 'country' => 'UK', 'timezone' => 'Europe/London', 'created_at' => now(), 'updated_at' => now()],
            ['iata' => 'CDG', 'icao' => 'LFPG', 'name' => 'Charles de Gaulle Airport', 'city' => 'Paris', 'country' => 'France', 'timezone' => 'Europe/Paris', 'created_at' => now(), 'updated_at' => now()],
            ['iata' => 'DXB', 'icao' => 'OMDB', 'name' => 'Dubai International Airport', 'city' => 'Dubai', 'country' => 'UAE', 'timezone' => 'Asia/Dubai', 'created_at' => now(), 'updated_at' => now()],
            ['iata' => 'FRA', 'icao' => 'EDDF', 'name' => 'Frankfurt Airport', 'city' => 'Frankfurt', 'country' => 'Germany', 'timezone' => 'Europe/Berlin', 'created_at' => now(), 'updated_at' => now()],
            ['iata' => 'SIN', 'icao' => 'WSSS', 'name' => 'Singapore Changi Airport', 'city' => 'Singapore', 'country' => 'Singapore', 'timezone' => 'Asia/Singapore', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
