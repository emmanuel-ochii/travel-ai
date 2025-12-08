<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\RecommendationController;
use App\Livewire\Flight\FlightDetails;
use App\Livewire\Flight\BookFlight;
use App\Livewire\Flight\CheckoutPaymentFlight;
use App\Livewire\Flight\RecommendedFlights;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use App\Models\User;

// Route::view('/', 'welcome');
Route::get('/', fn() => view('welcome'));



Route::prefix('/')->controller(FlightController::class)->group(function () {
    Route::get('search', 'search')->name('flights.search');
    // Route::get('details', 'details')->name('flights.details');
});

Route::get('/flights/{flight}', FlightDetails::class)->name('flights.details');


Route::middleware(['auth'])->group(function () {
    Route::get('/flight/{flight}/book', BookFlight::class)->name('flight.book');
    Route::get('/flights/{booking}/checkout-payment', CheckoutPaymentFlight::class)->name('flights.checkout_payment');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
    // Route::post('/recommendations/{flight}/feedback', [RecommendationController::class, 'feedback'])->name('recommendations.feedback');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/recommendations', RecommendedFlights::class)->name('recommendations.index');
});


Route::get('/test-groq', function () {
    $service = app(\App\Services\AI\GroqLLMService::class);

    return $service->getRecommendations([
        'persona' => 'budget traveler',
        'recent_bookings' => [],
        'candidates' => [
            ['id' => 1, 'origin' => 'LOS', 'destination' => 'DXB', 'price' => 450],
            ['id' => 2, 'origin' => 'LOS', 'destination' => 'LHR', 'price' => 820],
        ],
    ]);
});

// clear
Route::get('/fix-cache', function () {
    Artisan::call('permission:cache-reset');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return 'Cache cleared!';
});

Route::get('/make-admin', function () {
    $user = \App\Models\User::where('email', 'admin@test.com')->first();

    if (!$user) {
        return "User not found.";
    }

    if (!$user->hasRole('admin')) {
        $user->assignRole('admin');
    }

    return 'Admin role assigned to ' . $user->email;
});

Route::get('/grant-admin/{email}', function ($email) {

    // Ensure the admin role exists
    $role = Role::firstOrCreate(['name' => 'admin']);

    $user = User::where('email', $email)->first();

    if (!$user) {
        return "❌ User with email {$email} not found.";
    }

    // Assign role
    $user->assignRole($role);

    // Clear permission cache (important)
    Artisan::call('permission:cache-reset');

    return "✅ User {$user->email} is now an admin.";
});




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
