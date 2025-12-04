<?php

namespace App\Livewire\Flight;

use App\Models\Flight;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\InteractionLogger;

#[Layout('layouts.frontend')]
class FlightDetails extends Component
{
    public $flight;

    public function mount(Flight $flight)
    {
        $this->flight = $flight->load([
            'airline',
            'origin',
            'destination',
            'segments',
            'fares'
        ]);

        // Log flight view interaction
        InteractionLogger::log('view', [
            'flight_id' => $flight->id,
            'airline_id' => $flight->airline_id,
            'depart_at' => $flight->depart_at?->toIso8601String(),
        ]);
    }

    public function render()
    {
        return view('livewire.flight.flight-details');
    }
}
