<?php

namespace App\Livewire\Flight;

use App\Models\Flight;
use Livewire\Component;
use Livewire\Attributes\Layout;

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
    }
    public function render()
    {
        // dd($this->flight);
        return view('livewire.flight.flight-details');
    }
}
