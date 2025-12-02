<div>
    <div class="row">

        @forelse($flights as $flight)
            @livewire('flight.flight-card', ['flight' => $flight], key($flight->id))
        @empty
            <div class="col-12">
                <p>No flights found for the selected route and dates.</p>
            </div>
        @endforelse
    </div>

    {{-- <div class="col-lg-4 responsive-column">
        <div class="card-item flight-card flight--card">
            <div class="card-img">
                <img src="images/airline-img8.html" alt="flight-logo-img" />
            </div>
            <div class="card-body">
                <div class="card-top-title d-flex justify-content-between">
                    <div>
                        <h3 class="card-title font-size-17">Paris</h3>
                        <p class="card-meta font-size-14">Round flight</p>
                    </div>
                    <div>
                        <div class="text-end">
                            <span class="font-weight-regular font-size-14 d-block">avg/person</span>
                            <h6 class="font-weight-bold color-text">$650.00</h6>
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
                                <p class="card-meta font-size-14">Wed Nov 12 6:50 AM</p>
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
                                <p class="card-meta font-size-14">Thu Nov 13 8:50 AM</p>
                            </div>
                        </div>
                    </div>
                    <!-- end flight-time -->
                    <p class="font-size-14 text-center">
                        <span class="color-text-2 me-1">Total Time:</span>12 Hours
                        30 Minutes
                    </p>
                </div>
                <!-- end flight-details -->
                <div class="btn-box text-center">
                    <a href="flight-single.html" class="theme-btn theme-btn-small w-100">View Details</a>
                </div>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card-item -->
    </div> --}}
    <!-- end col-lg-4 -->
</div>
