<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Flight;
use App\Models\Fare;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Services\InteractionLogger;

#[Layout('layouts.frontend')]
class BookFlight extends Component
{
    public Flight $flight;

    public ?int $fareId = null;
    public ?Fare $fare = null;
    public int $adults = 1;
    public int $children = 0;
    public int $infants = 0;

    // Real-time computed totals (not stored)
    public int $totalPriceCents = 0;

    public function mount(Flight $flight, ?Fare $defaultFare = null)
    {
        $this->flight = $flight;

        // auto-select default fare (lowest)
        $selectedFare = $defaultFare ?? $flight->fares->sortBy('price_cents')->first();

        $this->fareId = $selectedFare->id;
        $this->fare = $selectedFare;

        // Initialize passengers
        $this->adults = 1;
        $this->children = 0;
        $this->infants = 0;

        $this->calculateTotal();
    }

    /** When the user changes fare selection */
    public function updatedFareId()
    {
        $this->fare = Fare::findOrFail($this->fareId);
        $this->calculateTotal();
    }

    /** Auto-recalculate on passenger change */
    public function updatedAdults()
    {
        $this->sanitizePassengers();
    }
    public function updatedChildren()
    {
        $this->sanitizePassengers();
    }
    public function updatedInfants()
    {
        $this->sanitizePassengers();
    }

    private function sanitizePassengers()
    {
        if ($this->adults < 1)
            $this->adults = 1;
        if ($this->children < 0)
            $this->children = 0;
        if ($this->infants < 0)
            $this->infants = 0;

        $this->calculateTotal();
    }

    /** MAIN REAL-TIME CALCULATION **/
    private function calculateTotal()
    {
        $totalPassengers = $this->adults + $this->children + $this->infants;

        $this->totalPriceCents = $this->fare->price_cents * $totalPassengers;
    }

    /** Save booking */
    public function submitBooking()
    {
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $this->flight->id,
            'fare_id' => $this->fare->id,
            'passengers' => $this->adults + $this->children + $this->infants,
            'total_price_cents' => $this->totalPriceCents,
            'currency' => $this->fare->currency,
            'status' => 'pending',
            'booking_reference' => Booking::generateReference(),
        ]);

        InteractionLogger::log('book', [
            'flight_id' => $this->flight->id,
            'fare_id' => $this->fare->id,
            'passengers' => $this->adults + $this->children + $this->infants,
            'total_price_cents' => $this->totalPriceCents,
        ]);


        session()->flash('success', "Booking confirmed! Reference: {$booking->booking_reference}");

        return redirect()->route('flights.details', $this->flight->id);
    }

    public function render()
    {
        return view('livewire.flight.book-flight');
    }
}
