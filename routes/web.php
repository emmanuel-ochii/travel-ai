<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('/')->controller(FlightController::class)->group(function () {
    Route::get('search', 'search')->name('flights.search');




});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
