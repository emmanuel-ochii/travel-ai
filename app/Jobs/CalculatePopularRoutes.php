<?php

namespace App\Jobs;


use App\Models\UserInteraction;
use App\Models\PopularRoute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculatePopularRoutes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Only consider 'search' interactions
        $routes = UserInteraction::where('type', 'search')
            ->get()
            ->pluck('payload.origin', 'payload.destination')
            ->map(fn($origin, $destination) => [
                'origin' => $origin,
                'destination' => $destination,
            ])
            ->groupBy(fn($item) => $item['origin'] . '-' . $item['destination'])
            ->map(fn($group) => [
                'origin' => $group[0]['origin'],
                'destination' => $group[0]['destination'],
                'search_count' => count($group),
                'calculated_at' => now(),
            ]);

        foreach ($routes as $route) {
            PopularRoute::updateOrCreate(
                [
                    'origin' => $route['origin'],
                    'destination' => $route['destination'],
                ],
                [
                    'search_count' => $route['search_count'],
                    'calculated_at' => $route['calculated_at'],
                ]
            );
        }
    }
}
