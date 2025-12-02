<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Flight;
use App\Models\Fare;
use App\Models\Booking;

class BookFlight extends Component
{
    public Flight $flight;
    public Fare $fare;

    public int $passengers = 1;
    public int $totalPriceCents = 0;

    public function mount($flightId, $fareId)
    {
        $this->flight = Flight::findOrFail($flightId);
        $this->fare   = Fare::findOrFail($fareId);

        $this->calculateTotal();
    }

    public function updatedPassengers()
    {
        if ($this->passengers < 1) $this->passengers = 1;
        $this->calculateTotal();
    }

    private function calculateTotal()
    {
        $this->totalPriceCents = $this->fare->price_cents * $this->passengers;
    }

    public function submitBooking()
    {
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $this->flight->id,
            'fare_id' => $this->fare->id,
            'passengers' => $this->passengers,
            'total_price_cents' => $this->totalPriceCents,
            'currency' => $this->fare->currency,
            'status' => 'pending',
            'booking_reference' => Booking::generateReference(),
        ]);

        return redirect()->route('booking.success', [
            'reference' => $booking->booking_reference,
        ]);
    }


    public function render()
    {
        return view('livewire.flight.book-flight');
    }
}
