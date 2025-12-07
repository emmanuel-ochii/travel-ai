<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Fare;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend')]
class CheckoutPaymentFlight extends Component
{
    public Flight $flight;
    public Fare $fare;
    public int $adults;
    public int $children;
    public int $infants;
    public int $totalPriceCents;

    public ?Booking $booking = null;

    public $first_name;
    public $last_name;
    public $phone;
    public $address;
    public $paymentMethod = 'card';

    public $paymentCompleted = false;

    public function mount()
    {
        $data = session('booking_data');

        if (!$data) {
            abort(404, 'Booking data missing.');
        }

        $this->flight = Flight::findOrFail($data['flight_id']);
        $this->fare = Fare::findOrFail($data['fare_id']);
        $this->adults = $data['adults'];
        $this->children = $data['children'];
        $this->infants = $data['infants'];
        $this->totalPriceCents = $data['totalPriceCents'];
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'paymentMethod' => 'required|in:card,bank_transfer',
        ];
    }

    public function submitPayment()
    {
        $this->validate();

        // Create Booking in DB
        $this->booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $this->flight->id,
            'fare_id' => $this->fare->id,
            'adults' => $this->adults,
            'children' => $this->children,
            'infants' => $this->infants,
            'total_price_cents' => $this->totalPriceCents,
            'currency' => $this->fare->currency,

            // Personal Info
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,

            'status' => 'confirmed',
            'booking_reference' => Booking::generateReference(),
        ]);

        // Hide the form and show confirmation message
        $this->paymentCompleted = true;

        // Clear session booking data
        session()->forget('booking_data');
    }

    public function render()
    {
        return view('livewire.flight.checkout-payment-flight', [
            'booking' => $this->booking,
        ]);
    }
}
