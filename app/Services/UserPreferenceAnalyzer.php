<?php

namespace App\Services;

use App\Models\UserInteraction;
use Illuminate\Support\Facades\Auth;

class UserPreferenceAnalyzer
{
    public static function getUserSignals(int $limit = 10)
    {
        $userId = Auth::id();

        if (!$userId) {
            return [];
        }

        $interactions = UserInteraction::where('user_id', $userId)
            ->where('type', 'search')
            ->latest()
            ->take($limit)
            ->get();

        if ($interactions->isEmpty()) {
            return [];
        }

        $routes = [];
        $cabinPreferences = [];
        $dates = [];

        foreach ($interactions as $interaction) {
            $payload = $interaction->payload;

            if (isset($payload['origin'], $payload['destination'])) {
                $routeKey = $payload['origin'] . '-' . $payload['destination'];
                $routes[$routeKey] = ($routes[$routeKey] ?? 0) + 1;
            }

            if (isset($payload['cabinClass'])) {
                $cabinPreferences[$payload['cabinClass']] = ($cabinPreferences[$payload['cabinClass']] ?? 0) + 1;
            }

            if (isset($payload['departing'])) {
                $dates[] = $payload['departing'];
            }
        }

        return [
            'top_route' => array_key_first(array_reverse($routes, true)),
            'top_cabin' => array_key_first(array_reverse($cabinPreferences, true)),
            'last_search_date' => end($dates),
            'search_count' => count($interactions),
            'route_weights' => $routes,
            'cabin_weights' => $cabinPreferences,
        ];
    }
}
