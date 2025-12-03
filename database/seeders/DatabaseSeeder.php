<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable FK checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Safe table clearing (delete instead of truncate)
        DB::table('bookings')->delete();
        DB::table('fares')->delete();
        DB::table('flights')->delete();
        DB::table('airports')->delete();
        DB::table('airlines')->delete();
        DB::table('users')->delete();

        // Run seeders in correct FK order
        $this->call([
            UsersSeeder::class,
            AirlineSeeder::class,
            AirportSeeder::class,
            FlightSeeder::class,
            FareSeeder::class,
            BookingsSeeder::class,
            UsersPersonaSeeder::class,
        ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
