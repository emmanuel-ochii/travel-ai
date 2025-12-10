<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\RecommendationController;
use App\Livewire\Flight\FlightDetails;
use App\Livewire\Flight\BookFlight;
use App\Livewire\Flight\CheckoutPaymentFlight;
use App\Livewire\Flight\RecommendedFlights;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\DashboardController;
use App\Livewire\Actions\Logout;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::prefix('/')->controller(FlightController::class)->group(function () {
    Route::get('search', 'search')->name('flights.search');
    // Route::get('details', 'details')->name('flights.details');
});

Route::get('/flights/{flight}', FlightDetails::class)->name('flights.details');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('user.booking');
    Route::get('/account', [DashboardController::class, 'account'])->name('user.account');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');


    Route::get('/reviews', [DashboardController::class, 'reviews'])->name('user.reviews');
    Route::get('/post-review/{booking}', [DashboardController::class, 'addReview'])
        ->name('user.post.review');
    Route::get('/view-review/{review}', [DashboardController::class, 'viewReview'])
        ->name('user.view.review');


    Route::get('/wishlist', [DashboardController::class, 'wishlist'])->name('user.wishlist');

    Route::get('/flight/{flight}/book', BookFlight::class)->name('flight.book');
    Route::get('/flights/{booking}/checkout-payment', CheckoutPaymentFlight::class)->name('flights.checkout_payment');

    Route::get('/recommendations', RecommendedFlights::class)->name('recommendations.index');
});
Route::get('/review/{booking}', [DashboardController::class, 'addReview'])->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
});


// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');




Route::post('/logout', function (Logout $logout) {
    $logout();
    return redirect('/');
})->name('logout');

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




require __DIR__ . '/auth.php';
