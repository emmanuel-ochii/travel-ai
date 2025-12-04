<div>
    <div class="card-item flight-card flight--card">
        <div class="card-img">
            <img src="{{ $flight->airline->logo_url ?? asset('guest/images/delta-airline.png') }}" alt="flight-logo-img" width="100"/>

        </div>
        <div class="card-body">
            <div class="card-top-title d-flex justify-content-between">
                <div>
                    <h3 class="card-title font-size-17"> {{ $flight->origin->city ?? '-' }} →
                        {{ $flight->destination->city ?? '-' }} </h3>
                    <p class="card-meta font-size-14">{{ ucfirst($flight->tripType ?? 'one-way') }} flight</p>
                </div>
                <div>
                    <div class="text-end">
                        <span class="font-weight-regular font-size-14 d-block">avg/person</span>
                        @php
                            $lowestFare = $flight->fares->min('price_cents') ?? 0;
                        @endphp
                        <h6 class="font-weight-bold color-text">
                            ${{ number_format($lowestFare / 100, 2) }}
                        </h6>
                    </div>
                </div>
            </div>
            <!-- end card-top-title -->
            <div class="flight-details py-3">
                <div class="flight-time pb-3">
                    <div class="flight-time-item take-off d-flex">
                        <div class="flex-shrink-0 me-2">
                            <i class="la la-plane"></i>
                        </div>
                        <div>
                            <h3 class="card-title font-size-15 font-weight-medium mb-0">
                                Take off
                            </h3>
                            <p class="card-meta font-size-14">
                                {{ $flight->depart_at->format('D, M d, Y H:i') ?? '-' }} </p>
                        </div>
                    </div>
                    <div class="flight-time-item landing d-flex">
                        <div class="flex-shrink-0 me-2">
                            <i class="la la-plane"></i>
                        </div>
                        <div>
                            <h3 class="card-title font-size-15 font-weight-medium mb-0">
                                Landing
                            </h3>
                            <p class="card-meta font-size-14">
                                {{ $flight->arrive_at->format('D, M d, Y H:i') ?? '-' }} </p>
                        </div>
                    </div>
                </div>
                <!-- end flight-time -->
                <p class="font-size-14 text-center">
                    <span class="color-text-2 me-1">Total Time:</span> {{ intdiv($flight->duration_minutes, 60) }}h
                    {{ $flight->duration_minutes % 60 }}m
                </p>
            </div>
            <!-- end flight-details -->
            <div class="btn-box text-center">
                <a href="{{ route('flights.details', $flight->id) }}" class="btn btn-primary">
                    View Details
                </a>
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card-item -->

</div>
