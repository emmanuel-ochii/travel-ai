<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PaymentFlight extends Component
{
    public Booking $booking;
    public $statusMessage = '';

    public function mount(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $this->booking = $booking;
    }

    public function pay()
    {
        // Simulate dummy payment
        $success = rand(0, 1); // random success/failure

        if ($success) {
            $this->booking->update([
                'status' => 'confirmed',
            ]);
            $this->statusMessage = 'Payment successful! Booking confirmed.';
        } else {
            $this->statusMessage = 'Payment failed. Please try again.';
        }
    }

    public function render()
    {
        return view('livewire.flight.payment-flight');
    }
}
