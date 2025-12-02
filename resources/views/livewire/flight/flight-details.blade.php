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
                                                <span
                                                    class="font-size-13">{{ $flight->depart_at->format('D, M d, Y H:i') ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="single-feature-titles text-center mb-3">
                                                <i class="la la-clock-o text-color font-size-22"></i>
                                                <span
                                                    class="font-size-13 mt-n2">{{ intdiv($flight->duration_minutes, 60) }}h
                                                    {{ $flight->duration_minutes % 60 }}m</span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 col-sm-4">
                                            <div class="single-feature-titles text-center mb-3">
                                                <h3 class="title font-size-15 font-weight-medium">
                                                    Flight Landing
                                                </h3>
                                                <span
                                                    class="font-size-13">{{ $flight->arrive_at->format('D, M d, Y H:i') ?? '-' }}</span>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-12">
                                            <div
                                                class="single-feature-titles text-center border-top border-bottom py-3 mb-4">
                                                <h3 class="title font-size-15 font-weight-medium">
                                                    Total flight time:<span
                                                        class="font-size-13 d-inline-block ms-1 text-gray">{{ intdiv($flight->duration_minutes, 60) }}h
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
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-user"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Flight Type
                                                    </h3>
                                                    <span class="font-size-13">Economy</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-refresh"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Fare Type
                                                    </h3>
                                                    <span class="font-size-13">Refundable</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-times"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Cancellation
                                                    </h3>
                                                    <span class="font-size-13">$78 / Person</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-exchange"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Flight Change
                                                    </h3>
                                                    <span class="font-size-13">$53 / Person</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-shopping-cart"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Seats & Baggage
                                                    </h3>
                                                    <span class="font-size-13">Extra Charge</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-gear"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Inflight Features
                                                    </h3>
                                                    <span class="font-size-13">Available</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-building"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Base Fare
                                                    </h3>
                                                    <span class="font-size-13">$320.00</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 responsive-column">
                                            <div class="single-tour-feature d-flex align-items-center mb-3">
                                                <div class="single-feature-icon icon-element ms-0 flex-shrink-0 me-3">
                                                    <i class="la la-money"></i>
                                                </div>
                                                <div class="single-feature-titles">
                                                    <h3 class="title font-size-15 font-weight-medium">
                                                        Taxes & Fees
                                                    </h3>
                                                    <span class="font-size-13">$300.00</span>
                                                </div>
                                            </div>
                                            <!-- end single-tour-feature -->
                                        </div>
                                        <!-- end col-lg-4 -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end single-content-item -->
                                <div class="section-block"></div>
                                <div class="single-content-item padding-top-40px padding-bottom-40px">
                                    <h3 class="title font-size-20">About Delta Airlines</h3>
                                    <p class="py-3">
                                        Per consequat adolescens ex, cu nibh commune temporibus
                                        vim, ad sumo viris eloquentiam sed. Mea appareat
                                        omittantur eloquentiam ad, nam ei quas oportere
                                        democritum. Prima causae admodum id est, ei timeam
                                        inimicus sed. Sit an meis aliquam, cetero inermis vel ut.
                                        An sit illum euismod facilisis, tamquam vulputate
                                        pertinacia eum at.
                                    </p>
                                    <p class="pb-3">
                                        Cum et probo menandri. Officiis consulatu pro et, ne sea
                                        sale invidunt, sed ut sint blandit efficiendi. Atomorum
                                        explicari eu qui, est enim quaerendum te. Quo harum viris
                                        id. Per ne quando dolore evertitur, pro ad cibo commune.
                                    </p>
                                    <p>
                                        Sed scelerisque lectus sit amet faucibus sodales. Proin ut
                                        risus tortor. Etiam fermentum tellus auctor, fringilla
                                        sapien et, congue quam. In a luctus tortor. Suspendisse
                                        eget tempor libero, ut sollicitudin ligula. Nulla
                                        vulputate tincidunt est non congue. Class aptent taciti
                                        sociosqu ad litora torquent per conubia nostra, per
                                        inceptos himenaeos. Phasellus at est imperdiet, dapibus
                                        ipsum vel, lacinia nulla.
                                    </p>
                                </div>
                                <!-- end single-content-item -->
                                <div class="section-block"></div>
                            </div>
                            <!-- end description -->

                            <div id="fare-rules" class="page-scroll">
                                <div class="single-content-item padding-top-40px padding-bottom-40px">
                                    <h3 class="title font-size-20">
                                        Fare Rules for your Flight
                                    </h3>
                                    <div class="fare-feature-item padding-top-30px pb-2">
                                        <div class="row">
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Rules And Policies
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Flight Changes
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Refunds
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Airline Penalties
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Flight Cancellation
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                            <div class="col-lg-4 responsive-column">
                                                <div class="single-tour-feature d-flex align-items-center mb-3">
                                                    <div
                                                        class="single-feature-icon icon-element ms-0 flex-shrink-0 me-2">
                                                        <i class="la la-check"></i>
                                                    </div>
                                                    <div class="single-feature-titles">
                                                        <h3 class="title font-size-15 font-weight-medium">
                                                            Airline Terms Of Use
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- end single-tour-feature -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <p>
                                        Maecenas vitae turpis condimentum metus tincidunt semper
                                        bibendum ut orci. Donec eget accumsan est. Duis laoreet
                                        sagittis elit et vehicula. Cras viverra posuere
                                        condimentum. Donec urna arcu, venenatis quis augue sit
                                        amet, mattis gravida nunc. Integer faucibus, tortor a
                                        tristique adipiscing, arcu metus luctus libero, nec
                                        vulputate risus elit id nibh.
                                    </p>
                                    <div class="accordion accordion-item padding-top-30px" id="accordionExample2">
                                        <div class="card">
                                            <div class="card-header" id="faqHeadingFour">
                                                <h2 class="mb-0">
                                                    <button
                                                        class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapseFour" aria-expanded="true"
                                                        aria-controls="faqCollapseFour">
                                                        <span class="ms-3">Flight cancellation charges</span>
                                                        <i class="la la-minus"></i>
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="faqCollapseFour" class="collapse show"
                                                aria-labelledby="faqHeadingFour" data-bs-parent="#accordionExample2">
                                                <div class="card-body d-flex">
                                                    <p>
                                                        Mea appareat omittantur eloquentiam ad, nam ei
                                                        quas oportere democritum. Prima causae admodum id
                                                        est, ei timeam inimicus sed. Sit an meis aliquam,
                                                        cetero inermis vel ut. An sit illum euismod
                                                        facilisis Nullam id dolor id nibh ultricies
                                                        vehicula ut id elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                        <div class="card">
                                            <div class="card-header" id="faqHeadingFive">
                                                <h2 class="mb-0">
                                                    <button
                                                        class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapseFive" aria-expanded="false"
                                                        aria-controls="faqCollapseFive">
                                                        <span class="ms-3">WAmendment in higher class charges</span>
                                                        <i class="la la-minus"></i>
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="faqCollapseFive" class="collapse"
                                                aria-labelledby="faqHeadingFive" data-bs-parent="#accordionExample2">
                                                <div class="card-body d-flex">
                                                    <p>
                                                        Mea appareat omittantur eloquentiam ad, nam ei
                                                        quas oportere democritum. Prima causae admodum id
                                                        est, ei timeam inimicus sed. Sit an meis aliquam,
                                                        cetero inermis vel ut. An sit illum euismod
                                                        facilisis Nullam id dolor id nibh ultricies
                                                        vehicula ut id elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                        <div class="card">
                                            <div class="card-header" id="faqHeadingSix">
                                                <h2 class="mb-0">
                                                    <button
                                                        class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapseSix" aria-expanded="false"
                                                        aria-controls="faqCollapseSix">
                                                        <span class="ms-3">Amendment in same class charges</span>
                                                        <i class="la la-minus"></i>
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="faqCollapseSix" class="collapse" aria-labelledby="faqHeadingSix"
                                                data-bs-parent="#accordionExample2">
                                                <div class="card-body d-flex">
                                                    <p>
                                                        Mea appareat omittantur eloquentiam ad, nam ei
                                                        quas oportere democritum. Prima causae admodum id
                                                        est, ei timeam inimicus sed. Sit an meis aliquam,
                                                        cetero inermis vel ut. An sit illum euismod
                                                        facilisis Nullam id dolor id nibh ultricies
                                                        vehicula ut id elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                        <div class="card">
                                            <div class="card-header" id="faqHeadingSeven">
                                                <h2 class="mb-0">
                                                    <button
                                                        class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapseSeven" aria-expanded="false"
                                                        aria-controls="faqCollapseSeven">
                                                        <span class="ms-3">Rebooking/cancellation charges</span>
                                                        <i class="la la-minus"></i>
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="faqCollapseSeven" class="collapse"
                                                aria-labelledby="faqHeadingSeven" data-bs-parent="#accordionExample2">
                                                <div class="card-body d-flex">
                                                    <p>
                                                        Mea appareat omittantur eloquentiam ad, nam ei
                                                        quas oportere democritum. Prima causae admodum id
                                                        est, ei timeam inimicus sed. Sit an meis aliquam,
                                                        cetero inermis vel ut. An sit illum euismod
                                                        facilisis Nullam id dolor id nibh ultricies
                                                        vehicula ut id elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                                <!-- end single-content-item -->
                                <div class="section-block"></div>
                            </div>
                            <!-- end rules faq -->
                        </div>
                        <!-- end single-content-wrap -->
                    </div>
                    <!-- end col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="sidebar single-content-sidebar mb-0">
                            <div class="sidebar-widget single-content-widget">
                                <div class="sidebar-widget-item">
                                    <div class="sidebar-book-title-wrap mb-3">
                                        <h3>{{ $flight->airline->name }} {{ $flight->flight_number }}</h3>
                                        @php
                                            $lowestFare = $flight->fares->sortBy('price_cents')->first();
                                        @endphp

                                        @if ($lowestFare)
                                            <p>
                                                <span class="text-form">From</span>
                                                <span class="text-value ms-2 me-1">
                                                    {{ number_format($lowestFare->price_cents / 100, 2) }}
                                                    {{ $lowestFare->currency }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-muted">No fare data available</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- end sidebar-widget-item -->
                                <div class="sidebar-widget-item">
                                    <div class="contact-form-action">
                                        <form action="#">
                                            <div class="input-box">
                                                <label class="label-text">Date</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        value="{{ $flight->depart_at->format('Y-m-d H:i') }}"
                                                        disabled />
                                                </div>
                                            </div>

                                            {{-- ⭐ CLASS DROPDOWN FROM DB --}}
                                            <div class="input-box">
                                                <label class="label-text">Preferred class</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            @foreach ($flight->fares as $fare)
                                                                <option value="{{ $fare->fare_class }}">
                                                                    {{ ucfirst($fare->fare_class) }}
                                                                    — {{ number_format($fare->price_cents / 100, 2) }}
                                                                    {{ $fare->currency }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end sidebar-widget-item -->
                                <div class="sidebar-widget-item">
                                    <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                        <label class="font-size-16">Adults <span>Age 18+</span></label>
                                        <div class="qtyBtn d-flex align-items-center">
                                            <div class="qtyDec"><i class="la la-minus"></i></div>
                                            <input type="text" name="qtyInput" value="0" />
                                            <div class="qtyInc"><i class="la la-plus"></i></div>
                                        </div>
                                    </div>
                                    <!-- end qty-box -->
                                    <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                        <label class="font-size-16">Children <span>2-12 years old</span></label>
                                        <div class="qtyBtn d-flex align-items-center">
                                            <div class="qtyDec"><i class="la la-minus"></i></div>
                                            <input type="text" name="qtyInput" value="0" />
                                            <div class="qtyInc"><i class="la la-plus"></i></div>
                                        </div>
                                    </div>
                                    <!-- end qty-box -->
                                    <div class="qty-box mb-2 d-flex align-items-center justify-content-between">
                                        <label class="font-size-16">Infants <span>0-2 years old</span></label>
                                        <div class="qtyBtn d-flex align-items-center">
                                            <div class="qtyDec"><i class="la la-minus"></i></div>
                                            <input type="text" name="qtyInput" value="0" />
                                            <div class="qtyInc"><i class="la la-plus"></i></div>
                                        </div>
                                    </div>
                                    <!-- end qty-box -->
                                </div>
                                <!-- end sidebar-widget-item -->
                                <div class="btn-box pt-2">
                                    <a href="flight-booking.html" class="theme-btn text-center w-100 mb-2"><i
                                            class="la la-shopping-cart me-2 font-size-18"></i>Book
                                        Now </a>
                                </div>
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


    <div>
        <h1 class="text-3xl font-bold">{{ $flight->airline->name }} {{ $flight->flight_number }}</h1>

        <p class="text-xl mt-2">
            {{ $flight->origin->city }} → {{ $flight->destination->city }}
        </p>

        <h2 class="font-semibold mt-6">Fare Options</h2>
        @foreach ($flight->fares as $fare)
            <p>{{ $fare->fare_class }} — {{ $fare->price_cents / 100 }} {{ $fare->currency }}</p>
        @endforeach

        <h2 class="font-semibold mt-6">Segments</h2>
        @foreach ($flight->segments as $seg)
            <p>{{ $seg->origin->city }} → {{ $seg->destination->city }}</p>
        @endforeach
    </div>
</div>
