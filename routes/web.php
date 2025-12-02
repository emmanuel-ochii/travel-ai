<?php

use App\Http\Controllers\FlightController;
use App\Livewire\Flight\FlightDetails;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('/')->controller(FlightController::class)->group(function () {
    Route::get('search', 'search')->name('flights.search');
    // Route::get('details', 'details')->name('flights.details');

});
Route::get('/flights/{flight}', FlightDetails::class)->name('flights.details');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
