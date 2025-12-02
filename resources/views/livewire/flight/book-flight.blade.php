<div class="sidebar-widget single-content-widget">
    <div class="sidebar-widget-item mb-3">
        <h3>Book Flight</h3>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <p>
            <strong>From:</strong> {{ $flight->origin->city }} <br>
            <strong>To:</strong> {{ $flight->destination->city }} <br>
            <strong>Date:</strong> {{ $flight->depart_at->format('D, M j, g:i A') }}
        </p>
    </div>

    <div class="sidebar-widget-item mb-3">
        <label class="label-text">Select Fare Class</label>
        <select wire:model="fareId" class="form-select">
            @foreach ($flight->fares as $f)
                <option value="{{ $f->id }}">
                    {{ ucfirst($f->fare_class) }} — {{ number_format($f->price_cents / 100, 2) }} {{ $f->currency }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Passenger Selection -->
    <div class="sidebar-widget-item mb-3">
        <label class="label-text">Adults</label>
        <input type="number" wire:model.live="adults" min="1" class="form-control">
    </div>

    <div class="sidebar-widget-item mb-3">
        <label class="label-text">Children</label>
        <input type="number" wire:model.live="children" min="0" class="form-control">
    </div>

    <div class="sidebar-widget-item mb-3">
        <label class="label-text">Infants</label>
        <input type="number" wire:model.live="infants" min="0" class="form-control">
    </div>


    <div class="sidebar-widget-item mb-3">
        <h5>Total: {{ $fare->currency ?? 'USD' }} {{ number_format($totalPriceCents / 100, 2) }}</h5>
    </div>

    <div class="sidebar-widget-item">
        <button wire:click="submitBooking" class="theme-btn w-100">
            Confirm Booking
        </button>

        @if (session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
