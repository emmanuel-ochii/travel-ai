<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserInteraction;
use App\Models\PopularRoute;

class UpdatePopularRoutes extends Command
{
    protected $signature = 'routes:update-popular';
    protected $description = 'Analyze interactions and update most searched routes';

    public function handle()
    {
        $searches = UserInteraction::where('type', 'search')->get();

        $routeCounts = [];

        foreach ($searches as $search) {
            $payload = $search->payload;

            if (!isset($payload['origin'], $payload['destination']))
                continue;

            $key = $payload['origin'] . '-' . $payload['destination'];

            $routeCounts[$key] = ($routeCounts[$key] ?? 0) + 1;
        }

        foreach ($routeCounts as $route => $count) {
            [$origin, $destination] = explode('-', $route);

            PopularRoute::updateOrCreate(
                ['origin' => $origin, 'destination' => $destination],
                ['search_count' => $count, 'calculated_at' => now()]
            );
        }

        $this->info("Popular routes updated successfully.");
    }
}
