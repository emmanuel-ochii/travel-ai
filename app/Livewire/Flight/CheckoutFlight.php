<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CheckoutFlight extends Component
{
    public Booking $booking;

    public $paymentMethod = 'card'; // 'card' or 'bank_transfer'

    public function mount(Booking $booking)
    {
        // Only allow owner
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $this->booking = $booking;
    }

    public function proceedToPayment()
    {
        // Redirect to payment page
        return redirect()->route('flights.payment', $this->booking->id);
    }

    public function render()
    {
        return view('livewire.flight.checkout-flight');
    }
}
