@extends('layouts.frontend')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center">
        <h2>
            Recommended Flights for {{ auth()->user()->name }}
            <small class="text-muted">(Persona: {{ auth()->user()->persona }})</small>
        </h2>

        {{-- 🔥 LLM Toggle --}}
        <form method="GET" action="{{ route('recommendations.index') }}">
            <div class="form-check form-switch">
                <input
                    type="checkbox"
                    name="use_llm"
                    value="1"
                    class="form-check-input"
                    id="llmToggle"
                    onchange="this.form.submit()"
                    {{ request('use_llm') ? 'checked' : '' }}>
                <label class="form-check-label" for="llmToggle">
                    AI-Enhanced Mode
                </label>
            </div>
        </form>
    </div>

    <hr>

    <div class="row mt-4">
        @forelse($recommendedFlights as $flight)
            <div class="col-md-6 mb-4">
                <div class="card p-3">

                    <h5>{{ $flight->airline->name }} — {{ $flight->flight_number }}</h5>

                    @if(!empty($flight->llm_influenced))
                        <span class="badge bg-info">🤖 AI Enhanced</span>
                    @endif

                    <p>
                        <strong>From:</strong> {{ $flight->origin->city ?? 'Unknown' }}
                        ({{ $flight->origin->iata ?? '' }})<br>

                        <strong>To:</strong> {{ $flight->destination->city ?? 'Unknown' }}
                        ({{ $flight->destination->iata ?? '' }})<br>

                        <strong>Departure:</strong>
                        {{ $flight->depart_at->format('D, M j, g:i A') }}<br>

                        <strong>Arrival:</strong>
                        {{ $flight->arrive_at->format('D, M j, g:i A') }}<br>

                        @php
                            $lowestFare = $flight->fares->sortBy('price_cents')->first();
                        @endphp

                        <strong>Lowest Fare:</strong>
                        {{ $lowestFare->currency ?? 'USD' }}
                        {{ number_format($lowestFare->price_cents / 100, 2) ?? 'N/A' }}
                    </p>

                    <p><strong>Score:</strong> {{ number_format($flight->score, 2) }}</p>

                    @if (!empty($flight->reason))
                    <p><em>Reason:</em> {{ $flight->reason }}</p>
                    @endif

                    <a
                        href="{{ route('flight.book', [$flight->id, $lowestFare->id ?? 0]) }}"
                        class="btn btn-primary"
                    >
                        Book Now
                    </a>

                </div>
            </div>
        @empty
            <p>No recommendations available yet.</p>
        @endforelse
    </div>
</div>
@endsection
