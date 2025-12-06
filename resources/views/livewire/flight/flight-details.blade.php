<div>

    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area bread-bg-6 py-0">
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-btn">

                        </div>
                        <!-- end breadcrumb-btn -->
                    </div>
                    <!-- end col-lg-12 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end breadcrumb-wrap -->
    </section>
    <!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
        START TOUR DETAIL AREA
    ================================= -->
    <section class="tour-detail-area padding-bottom-90px">
        <div class="single-content-navbar-wrap menu section-bg" id="single-content-navbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content-nav" id="single-content-nav">
                            <ul>
                                <li>
                                    <a data-scroll="description" href="#description" class="scroll-link active">Flight
                                        Details</a>
                                </li>
                                <li>
                                    <a data-scroll="fare-rules" href="#fare-rules" class="scroll-link">Fare Rules</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single-content-navbar-wrap -->
        <div class="single-content-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-content-wrap padding-top-60px">
                            <div id="description" class="page-scroll">
                                <div class="single-content-item pb-4">
                                    <img src="{{ $flight->airline->logo_url ?? asset('guest/images/delta-airline.png') }}"
                                        alt="flight-logo-img" width="280" />
                                    <h3 class="title font-size-26">{{ $flight->origin->city }} to
                                        {{ $flight->destination->city }}</h3>
                                    <div class="d-flex align-items-center pt-2">
                                        <p class="me-2">{{ ucfirst($flight->tripType ?? 'one-way') }} flight</p>
                                        <p>
                                            <span
                                                class="badge text-bg-warning text-white font-weight-medium font-size-16">1
                                                Stop</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- end single-content-item -->
                                <div class="section-block"></div>
                                <div class="single-content-item py-4">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="single-feature-titles text-center mb-3">
                                                <h3 class="title font-size-15 font-weight-medium">
                                                    Flight Take off
                                                </h3>
                                                <span class="font-size-13">{{ $flight->depart_at->format('D, M d, Y
                                                    H:i') ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="single-feature-titles text-center mb-3">
                                                <i class="la la-clock-o text-color font-size-22"></i>
                                                <span class="font-size-13 mt-n2">{{ intdiv($flight->duration_minutes,
                                                    60) }}h
                                                    {{ $flight->duration_minutes % 60 }}m</span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="single-feature-titles text-center mb-3">
                                                <h3 class="title font-size-15 font-weight-medium">
                                                    Flight Landing
                                                </h3>
                                                <span class="font-size-13">{{ $flight->arrive_at->format('D, M d, Y
                                                    H:i') ??
                                                    '-' }}</span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-12">
                                            <div
                                                class="single-feature-titles text-center border-top border-bottom py-3 mb-4">
                                                <h3 class="title font-size-15 font-weight-medium">
                                                    Total flight time:<span
                                                        class="font-size-13 d-inline-block ms-1 text-gray">{{
                                                        intdiv($flight->duration_minutes, 60) }}h
                                                        {{ $flight->duration_minutes % 60 }}m</span>
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- end col-lg-12 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-plane"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Airline
                                                    </h3>

                                                    <span class="font-size-13">{{ $flight->airline->name }}
                                                        {{ $flight->flight_number }}</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                            <!-- end description -->
                        </div>
                        <!-- end single-content-wrap -->
                    </div>
                    <!-- end col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="sidebar single-content-sidebar mb-0">
                            <div class="sidebar-widget single-content-widget">
                                <div class="sidebar-widget-item">
                                    <div class="sidebar-book-title-wrap mb-3">
                                        <img src="{{ $flight->airline->logo_url ?? asset('guest/images/delta-airline.png') }}"
                                            alt="flight-logo-img" width="150" />
                                        <h3>{{ $flight->airline->name }} {{ $flight->flight_number }}</h3>

                                        <!-- Integrated Booking Form -->
                                        {{-- @livewire('flight.book-flight', [
                                        'flight' => $flight,
                                        'defaultFare' => $flight->fares->sortBy('price_cents')->first(),
                                        ]) --}}

                                        @auth
                                        <livewire:flight.book-flight :flight="$flight" />
                                        @else
                                        <a href="{{ route('login') }}" class="theme-btn text-center w-100 mb-2">
                                            <i class="la la-sign-in me-2 font-size-18"></i>
                                            Login to Book
                                        </a>
                                        @endauth

                                        <!-- end sidebar-widget-item -->
                                    </div>
                                    <!-- end sidebar-widget -->
                                </div>
                                <!-- end sidebar -->
                            </div>
                            <!-- end col-lg-4 -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- end single-content-box -->
    </section>
    <!-- end tour-detail-area -->
    <!-- ================================
        END TOUR DETAIL AREA
    ================================= -->
</div>
