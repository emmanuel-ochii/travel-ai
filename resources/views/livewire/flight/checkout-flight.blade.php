<div>
    <div class="checkout-widget">
        <h3>Checkout Booking</h3>

        <p><strong>Reference:</strong> {{ $booking->booking_reference }}</p>
        <p><strong>Flight:</strong> {{ $booking->flight->origin->city }} → {{ $booking->flight->destination->city }}</p>
        <p><strong>Date:</strong> {{ $booking->flight->depart_at->format('D, M j, g:i A') }}</p>
        <p><strong>Passengers:</strong> {{ $booking->passengers }}</p>
        <p><strong>Total:</strong> {{ $booking->currency }} {{ number_format($booking->total_price_cents / 100, 2) }}
        </p>

        <div class="mb-3">
            <label>Payment Method</label>
            <select wire:model="paymentMethod" class="form-select">
                <option value="card">Card Payment</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <button wire:click="proceedToPayment" class="btn btn-primary w-100">
            Proceed to Payment
        </button>
    </div>

</div>
