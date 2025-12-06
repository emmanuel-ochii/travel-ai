<?php

namespace App\Livewire\Homepage;

use Livewire\Component;
use App\Models\PopularRoute;
use App\Models\Airport;
use App\Models\Flight;

class PopularRoutes extends Component
{
    public $popularTabs;

    public function mount()
    {
        $this->popularTabs = $this->loadPopularRoutes();
    }

    private function loadPopularRoutes()
    {
        $popular = PopularRoute::orderBy('search_count', 'desc')
            ->limit(8)
            ->get();

        $routesForView = [];

        foreach ($popular as $pr) {
            $originKey = $pr->origin;
            $destinationKey = $pr->destination;

            $originAirport = Airport::where('iata', $originKey)
                ->orWhere('city', $originKey)
                ->first();

            $destinationAirport = Airport::where('iata', $destinationKey)
                ->orWhere('city', $destinationKey)
                ->first();

            $originLabel = $originAirport?->city ?? $originAirport?->name ?? $originKey;
            $destinationLabel = $destinationAirport?->city ?? $destinationAirport?->name ?? $destinationKey;

            $flightQuery = Flight::with([
                'fares' => fn($q) => $q->orderBy('price_cents', 'asc'),
                'airline',
                'origin',
                'destination'
            ])
                ->whereRelation('origin', fn($q) => $q->where('iata', $originKey)->orWhere('city', $originKey))
                ->whereRelation('destination', fn($q) => $q->where('iata', $destinationKey)->orWhere('city', $destinationKey));

            $flight = (clone $flightQuery)
                ->where('depart_at', '>=', now()->subDay())
                ->orderBy('depart_at')
                ->first()
                ?? (clone $flightQuery)->orderBy('depart_at')->first();

            $price = $flight?->fares->first()->price_cents ?? $flight?->base_price_cents;
            $currency = $flight?->fares->first()->currency ?? $flight?->currency ?? 'USD';
            $formattedPrice = $price ? number_format($price / 100, 0, '.', ',') : null;
            $logo = $flight?->airline?->logo_url ?? '/images/airline-placeholder.png';

            $routesForView[] = [
                'origin_label' => $originLabel,
                'destination_label' => $destinationLabel,
                'price' => $formattedPrice,
                'currency' => $currency,
                'logo' => $logo,
                'flight_detail_url' => $flight ? route('flights.details', $flight->id) : '#',
                'depart_at' => optional($flight?->depart_at)->toDateString(),
                'arrive_at' => optional($flight?->arrive_at)->toDateString(),
            ];
        }

        return collect($routesForView)->groupBy('origin_label');
    }


    public function render()
    {
        return view('livewire.homepage.popular-routes');
    }
}
