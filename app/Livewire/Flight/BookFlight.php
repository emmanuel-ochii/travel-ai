<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Flight;
use App\Models\Fare;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookFlight extends Component
{
    public Flight $flight;
    public ?int $fareId = null;
    public ?Fare $fare = null;
    public int $adults = 1;
    public int $children = 0;
    public int $infants = 0;
    public int $totalPriceCents = 0;

    public function mount(Flight $flight)
    {
        $this->flight = $flight;
        $selectedFare = $flight->fares->sortBy('price_cents')->first();
        $this->fareId = $selectedFare->id;
        $this->fare = $selectedFare;
        $this->calculateTotal();
    }

    public function updatedFareId()
    {
        $this->fare = Fare::findOrFail($this->fareId);
        $this->calculateTotal();
    }

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
        $this->adults = max(1, $this->adults);
        $this->children = max(0, $this->children);
        $this->infants = max(0, $this->infants);
        $this->calculateTotal();
    }

    private function calculateTotal()
    {
        $totalPassengers = $this->adults + $this->children + $this->infants;
        $this->totalPriceCents = $this->fare->price_cents * $totalPassengers;
    }

    public function submitBooking()
    {
        // Redirect to CheckoutPaymentFlight with all data
        // return redirect()->route('flights.checkout_payment', [
        //     'flight' => $this->flight->id,
        //     'fare' => $this->fare->id,
        //     'adults' => $this->adults,
        //     'children' => $this->children,
        //     'infants' => $this->infants,
        //     'totalPriceCents' => $this->totalPriceCents,
        // ]);

        if (!$this->fareId) {
            session()->flash('error', 'Please select a fare class.');
            return;
        }

        // Create a temporary booking record (pending)
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $this->flight->id,
            'fare_id' => $this->fare->id,
            'adults' => $this->adults,
            'children' => $this->children,
            'infants' => $this->infants,
            'total_price_cents' => $this->totalPriceCents,
            'currency' => $this->fare->currency,
            'status' => 'pending',
            'booking_reference' => Booking::generateReference(),
        ]);

        // Store booking data in session if needed
        session([
            'booking_data' => [
                'flight_id' => $this->flight->id,
                'fare_id' => $this->fare->id,
                'adults' => $this->adults,
                'children' => $this->children,
                'infants' => $this->infants,
                'totalPriceCents' => $this->totalPriceCents,
            ]
        ]);

        // Redirect with booking ID
        return redirect()->route('flights.checkout_payment', ['booking' => $booking->id]);

    }

    public function render()
    {
        return view('livewire.flight.book-flight');
    }
}
