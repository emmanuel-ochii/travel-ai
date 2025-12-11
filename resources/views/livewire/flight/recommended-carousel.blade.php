<div>
    <section class="hotel-area section-bg section-padding overflow-hidden padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="section-heading text-center">
                <h2 class="sec__title line-height-55">Recommendations<br>For This Trip</h2>
            </div>

            @if ($loading && empty($recommendations))
                <div class="text-center py-5">
                    <p>🔄 Finding best flights for {{ $origin }} to {{ $destination }}...</p>
                </div>
            @elseif (empty($recommendations))
                <div class="text-center py-4 text-muted">
                    <p>
                        @if($origin && $destination)
                            No specific recommendations found for <strong>{{ $origin }} → {{ $destination }}</strong>.
                        @else
                            No personalized recommendations yet.
                        @endif
                    </p>
                </div>
            @else
                <div class="hotel-card-wrap padding-top-50px">
                    <div class="hotel-card-carousel carousel-action">
                        @foreach ($recommendations as $flight)
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="{{ route('flights.details', $flight->id) }}" class="d-block">
                                        <img src="{{ $flight->airline->logo_url ?? '/images/airline-placeholder.png' }}" alt="airline-img">
                                    </a>
                                    @if ($flight->discount)
                                        <span class="badge">Cheaper</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="{{ route('flights.details', $flight->id) }}">{{ $flight->airline->name }}</a>
                                    </h3>
                                    <p class="card-meta">{{ $flight->origin->city }} → {{ $flight->destination->city }}</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">{{ $flight->stops }} stop(s)</span>
                                        <span class="review__text">{{ $flight->reason ?? 'Suggested' }}</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">
                                                @php
                                                    $lowestFare = $flight->fares->min('price_cents') ?? 0;
                                                @endphp
                                                {{ number_format($lowestFare / 100, 2) }}
                                            </span>
                                        </p>
                                        <a href="{{ route('flights.details', $flight->id) }}" class="btn-text">See details <i class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if($useLlm)
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.hook('message.processed', (message, component) => {
                   // Re-init carousel plugin after update if needed
                   if(typeof initCarousel === 'function') initCarousel();
                });

                // Refresh every 30s
                setInterval(() => {
                    @this.refreshRecommendations();
                }, 30000);
            });
        </script>
    @endif
</div>
