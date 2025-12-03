<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Protect admin panel IMMEDIATELY
        // Filament::auth(function ($user) {
        //     return $user && $user->hasRole('admin');
        // });

        // UI and navigation settings AFTER auth
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Admin' => 1,
            ]);
        });
    }
}
