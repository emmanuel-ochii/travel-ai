<div>
    <div class="row">
    @forelse($flights as $flight)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            @livewire('flight.flight-card', ['flight' => $flight], key($flight->id))
        </div>
    @empty
        <div class="col-12">
            <p>No flights found for the selected route and dates.</p>
        </div>
    @endforelse
</div>

</div>
