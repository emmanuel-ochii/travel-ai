<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\RecommendationController;
use App\Livewire\Flight\FlightDetails;
use App\Livewire\Flight\BookFlight;
use App\Livewire\Flight\RecommendedFlights;
use Illuminate\Support\Facades\Route;
use App\Models\PopularRoute;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Support\Str;

// Route::view('/', 'welcome');
Route::get('/livewire', fn() => view('welcome'));
Route::get('/', function () {
    // Get top popular routes
    $popular = PopularRoute::orderBy('search_count', 'desc')
        ->limit(8)
        ->get();

    $routesForView = [];

    foreach ($popular as $pr) {
        $originKey = $pr->origin;
        $destinationKey = $pr->destination;

        // Try to find airport by IATA code first, then by city name as fallback
        $originAirport = Airport::where('iata', $originKey)
            ->orWhere('city', $originKey)
            ->first();

        $destinationAirport = Airport::where('iata', $destinationKey)
            ->orWhere('city', $destinationKey)
            ->first();

        $originLabel = $originAirport ? ($originAirport->city ? $originAirport->city : $originAirport->name) : $originKey;
        $destinationLabel = $destinationAirport ? ($destinationAirport->city ? $destinationAirport->city : $destinationAirport->name) : $destinationKey;

        // Find a representative flight for this route.
        // Prefer upcoming flights, but fall back to any existing flight.
        $flightQuery = Flight::with([
            'fares' => function ($q) {
                $q->orderBy('price_cents', 'asc');
            },
            'airline',
            'origin',
            'destination'
        ])
            ->whereHas('origin', function ($q) use ($originKey) {
                $q->where('iata', $originKey)->orWhere('city', $originKey);
            })
            ->whereHas('destination', function ($q) use ($destinationKey) {
                $q->where('iata', $destinationKey)->orWhere('city', $destinationKey);
            });

        $flight = (clone $flightQuery)
            ->where('depart_at', '>=', now()->subDay()) // upcoming (allow yesterday tolerance)
            ->orderBy('depart_at', 'asc')
            ->first();

        if (!$flight) {
            // fallback to any flight for the route
            $flight = (clone $flightQuery)->orderBy('depart_at', 'asc')->first();
        }

        $price = null;
        $currency = 'USD';
        $fareId = null;
        if ($flight) {
            if ($flight->fares && $flight->fares->count()) {
                $fare = $flight->fares->first();
                $price = $fare->price_cents;
                $currency = $fare->currency ?? $flight->currency ?? $currency;
                $fareId = $fare->id;
            } else {
                $price = $flight->base_price_cents;
                $currency = $flight->currency ?? $currency;
            }
        }

        // Format price (cents to dollars - assumes cents)
        $formattedPrice = $price !== null ? number_format($price / 100, 0, '.', ',') : null;

        // Airline logo (assumes airline has logo_url column)
        $logo = optional($flight->airline)->logo_url ?? '/images/airline-placeholder.png';

        $routesForView[] = [
            'origin_key' => $originKey,
            'destination_key' => $destinationKey,
            'origin_label' => $originLabel,
            'destination_label' => $destinationLabel,
            'search_count' => $pr->search_count,
            'calculated_at' => $pr->calculated_at,
            'flight' => $flight, // may be null
            'price' => $formattedPrice,
            'currency' => $currency,
            'logo' => $logo,
            'flight_detail_url' => $flight ? route('flights.details', $flight->id) : '#',
            'depart_at' => $flight ? optional($flight->depart_at)->toDateString() : null,
            'arrive_at' => $flight ? optional($flight->arrive_at)->toDateString() : null,
        ];
    }

    // Group routes by origin label to build tabs similar to your template
    $tabs = collect($routesForView)->groupBy('origin_label');

    return view('welcome', [
        'popularTabs' => $tabs,
    ]);
});














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





Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
