<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FlightSearchService;
use App\Providers\FlightApiProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register FlightApiProvider singleton
        $this->app->singleton(FlightApiProvider::class, function ($app) {
            return new FlightApiProvider();
        });

        // Register FlightSearchService singleton
        $this->app->singleton(FlightSearchService::class, function ($app) {
            return new FlightSearchService(
                $app->make(FlightApiProvider::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
