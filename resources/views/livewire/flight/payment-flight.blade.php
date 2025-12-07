<div>
    <div class="payment-widget">
    <h3>Complete Payment</h3>

    <p><strong>Booking Ref:</strong> {{ $booking->booking_reference }}</p>
    <p><strong>Total:</strong> {{ $booking->currency }} {{ number_format($booking->total_price_cents / 100, 2) }}</p>
    <p><strong>Method:</strong> {{ ucfirst($booking->payment_method ?? 'Card') }}</p>

    <button wire:click="pay" class="btn btn-success w-100 mb-3">Pay Now</button>

    @if($statusMessage)
        <div class="alert alert-info mt-3">{{ $statusMessage }}</div>
    @endif
</div>

</div>
