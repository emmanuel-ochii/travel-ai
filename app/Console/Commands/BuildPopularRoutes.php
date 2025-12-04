<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class BuildPopularRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:build-popular-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build aggregated flight route popularity from user interactions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Step 1: Aggregate interaction logs
        $popularRoutes = DB::table('user_interactions')
            ->selectRaw("
                payload->>'$.origin' AS origin,
                payload->>'$.destination' AS destination,
                COUNT(*) as cnt
            ")
            ->where('type', 'search')
            ->groupBy('origin', 'destination')
            ->orderByDesc('cnt')
            ->limit(50)
            ->get();

        // Step 2: Cache the result (optional but recommended)
        Cache::put('popular_routes', $popularRoutes, now()->addHours(24));

        // Step 3: Optional — persist into reporting table
        DB::table('popular_routes')->truncate(); // clears old data

        foreach ($popularRoutes as $route) {
            DB::table('popular_routes')->insert([
                'origin' => $route->origin,
                'destination' => $route->destination,
                'search_count' => $route->cnt,
                'calculated_at' => now(),
            ]);
        }

        $this->info("Popular route analytics built successfully. Top {$popularRoutes->count()} stored.");
    }
}
