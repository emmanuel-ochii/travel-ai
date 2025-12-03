@extends('layouts.frontend')

@section('content')
    <div class="container mt-5">
        <h2>Recommended Flights for {{ auth()->user()->name }} (Persona: {{ auth()->user()->persona }})</h2>

        <div class="row mt-4">
            @forelse($recommendedFlights as $flight)
                <div class="col-md-6 mb-4">
                    <div class="card p-3">
                        <h5>{{ $flight->airline->name }} — {{ $flight->flight_number }}</h5>
                        <p>
                            <strong>From:</strong> {{ $flight->origin->city ?? 'Unknown' }}
                            ({{ $flight->origin->iata ?? '' }})
                            <br>
                            <strong>To:</strong> {{ $flight->destination->city ?? 'Unknown' }}
                            ({{ $flight->destination->iata ?? '' }})<br>
                            <strong>Departure:</strong> {{ $flight->depart_at->format('D, M j, g:i A') }}<br>
                            <strong>Arrival:</strong> {{ $flight->arrive_at->format('D, M j, g:i A') }}<br>
                            <strong>Lowest Fare:</strong>
                            @php $lowestFare = $flight->fares->sortBy('price_cents')->first() @endphp
                            {{ $lowestFare->currency ?? 'USD' }}
                            {{ number_format($lowestFare->price_cents / 100, 2) ?? 'N/A' }}<br>
                        <p>
                            <strong>Recommendation Score:</strong> {{ number_format($flight->score, 2) }}
                        </p>

                        @if (!empty($flight->reason))
                            <p><em>Why recommended:</em> {{ $flight->reason }}</p>
                        @endif

                        <p class="text-muted">
                        <strong>Why recommended:</strong>
                        @php
                            $reasons = [];
                            if (isset($flight->destination_airport_id) && in_array($flight->destination_airport_id, auth()->user()->bookings->pluck('flight.destination_airport_id')->toArray())) {
                                $reasons[] = "Popular destination for you";
                            }
                            if (isset($flight->airline_id) && in_array($flight->airline_id, auth()->user()->bookings->pluck('flight.airline_id')->toArray())) {
                                $reasons[] = "Preferred airline";
                            }
                            if ($flight->depart_at->month == now()->month) {
                                $reasons[] = "Seasonal deal this month";
                            }
                            if (empty($reasons)) {
                                $reasons[] = "Good match for your persona";
                            }
                        @endphp
                        {{ implode(', ', $reasons) }}
                    </p>


                        </p>

                        <a href="{{ route('flight.book', [$flight->id, $lowestFare->id ?? 0]) }}" class="btn btn-primary">
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
