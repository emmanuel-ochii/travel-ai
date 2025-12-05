<div>
    <div class="container mt-5">
        <h2>
            Recommended Flights for {{ auth()->user()->name }} (Persona: {{ auth()->user()->persona }})
            @if($useLlm)
                <span class="badge bg-info ms-2">LLM Enabled</span>
            @endif
        </h2>

        <div class="mb-3">
            <button wire:click="toggleLLM" class="btn btn-secondary">
                {{ $useLlm ? 'Disable LLM Recommendations' : 'Enable LLM Recommendations' }}
            </button>
        </div>

        <div class="row mt-4">
            @forelse($recommendedFlights as $flight)
                @php
                    $lowestFare = $flight->fares->sortBy('price_cents')->first();
                    $llmInfluenced = str_contains($flight->reason ?? '', ';');

                    // Log that the user viewed this flight card
                    \App\Services\InteractionLogger::log('view', [
                        'flight_id' => $flight->id,
                        'fare_id' => $lowestFare->id ?? null,
                    ]);
                @endphp

                <div class="col-md-6 mb-4">
                    <div class="card p-3 {{ $llmInfluenced ? 'border-info shadow-sm' : '' }}">
                        <h5>{{ $flight->airline->name }} — {{ $flight->flight_number }}</h5>

                        <p>
                            <strong>From:</strong> {{ $flight->origin->city ?? 'Unknown' }}
                            ({{ $flight->origin->iata ?? '' }})<br>
                            <strong>To:</strong> {{ $flight->destination->city ?? 'Unknown' }}
                            ({{ $flight->destination->iata ?? '' }})<br>
                            <strong>Departure:</strong> {{ $flight->depart_at->format('D, M j, g:i A') }}<br>
                            <strong>Arrival:</strong> {{ $flight->arrive_at->format('D, M j, g:i A') }}<br>
                            <strong>Lowest Fare:</strong> {{ $lowestFare->currency ?? 'USD' }}
                            {{ number_format($lowestFare->price_cents / 100, 2) ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Recommendation Score:</strong> {{ number_format($flight->score, 2) }}
                            @if($llmInfluenced)
                                <span class="badge bg-info ms-1">LLM Adjusted</span>
                            @endif
                        </p>

                        <p>
                            <strong>Why recommended:</strong> {{ $flight->reason ?: 'No reason provided' }}
                        </p>

                        <a href="{{ route('flight.book', [$flight->id, $lowestFare->id ?? 0]) }}"
                           class="btn btn-primary"
                           wire:click.prevent="\App\Services\InteractionLogger::log('select_fare', ['flight_id' => {{ $flight->id }}, 'fare_id' => {{ $lowestFare->id ?? 0 }}])">
                            Book Now
                        </a>
                    </div>
                </div>
            @empty
                <p>No recommendations available yet.</p>
            @endforelse
        </div>
    </div>
</div>
