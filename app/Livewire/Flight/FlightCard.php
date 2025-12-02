<?php

namespace App\Livewire\Flight;

use Livewire\Component;

class FlightCard extends Component
{
    public $flight;
    
    public function mount($flight)
    {
        $this->flight = $flight;
    }

    public function viewDetails()
    {
        if (isset($this->flight->id)) {
            return redirect()->route('flights.details', ['flight' => $this->flight->id]);
        }

        session()->flash('message', 'Detailed view not available for provider flights in mock.');
    }

    public function render()
    {
        return view('livewire.flight.flight-card');
    }
}
