<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('airlines')->insert([
            ['code' => 'AA', 'name' => 'American Airlines', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BA', 'name' => 'British Airways', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'DL', 'name' => 'Delta Airlines', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'AF', 'name' => 'Air France', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'LH', 'name' => 'Lufthansa', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EK', 'name' => 'Emirates', 'logo_url' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
