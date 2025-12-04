<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Airport;
use App\Services\InteractionLogger;

class SearchForm extends Component
{
    public $tripType = 'one-way';
    public $from;
    public $to;
    public $departing;
    public $returning;
    public $adults = 1;
    public $children = 0;
    public $infants = 0;
    public $cabinClass = 'Economy';

    public $airports = [];

    public function mount()
    {
        // Load airports for dropdown
        $this->airports = Airport::orderBy('city')->get();
    }

    public function submit()
    {
        // Validate input
        $this->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departing' => 'required|date',
            'returning' => $this->tripType === 'round-trip' ? 'required|date|after_or_equal:departing' : 'nullable',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'infants' => 'nullable|integer|min:0',
        ]);

        InteractionLogger::log('search', [
            'origin' => $this->from,
            'destination' => $this->to,
            'departing' => $this->departing,
            'tripType' => $this->tripType,
            'adults' => $this->adults,
            'cabinClass' => $this->cabinClass,
        ]);


        // Redirect to results with query params
        return redirect()->route('flights.search', [
            'from' => $this->from,
            'to' => $this->to,
            'departing' => $this->departing,
            'returning' => $this->returning,
            'adults' => $this->adults,
            'children' => $this->children,
            'infants' => $this->infants,
            'cabinClass' => $this->cabinClass,
            'tripType' => $this->tripType,
        ]);
    }


    public function render()
    {
        return view('livewire.flight.search-form');
    }
}
