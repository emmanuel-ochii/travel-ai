<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        // ⏳ Run your analytics command daily
        $schedule->command('routes:update-popular')->daily();
        // Or every hour if you want fresher data:
        // $schedule->command('analytics:build-popular-routes')->hourly();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
