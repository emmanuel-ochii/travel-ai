<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\RecommendationController;
use App\Livewire\Flight\FlightDetails;
use App\Livewire\Flight\BookFlight;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('/')->controller(FlightController::class)->group(function () {
    Route::get('search', 'search')->name('flights.search');
    // Route::get('details', 'details')->name('flights.details');
});

Route::get('/flights/{flight}', FlightDetails::class)->name('flights.details');




// Route::get('/flight/{flightId}/book/{fareId}', BookFlight::class)
//     ->name('flight.book');

Route::middleware(['auth'])->group(function () {
    Route::get('/flight/{flight}/book', BookFlight::class)->name('flight.book');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
    Route::post('/recommendations/{flight}/feedback', [RecommendationController::class, 'feedback'])->name('recommendations.feedback');
});









Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
