@extends('layouts.frontend')

@section('content')
    <!-- ================================
                    START HERO-WRAPPER AREA
                ================================= -->
    <section class="hero-wrapper">
        <div class="hero-box hero-bg">
            <span class="line-bg line-bg1"></span>
            <span class="line-bg line-bg2"></span>
            <span class="line-bg line-bg3"></span>
            <span class="line-bg line-bg4"></span>
            <span class="line-bg line-bg5"></span>
            <span class="line-bg line-bg6"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto responsive--column-l">

                        <div class="hero-content pb-5">
                            <div class="section-heading">
                                <h2 class="sec__title cd-headline zoom">
                                    Amazing
                                    <span class="cd-words-wrapper">
                                        <b class="is-visible">Tours</b>
                                        <b>Adventures</b>
                                        <b>Flights</b>
                                        <b>Hotels</b>
                                        <b>Cars</b>
                                        <b>Cruises</b>
                                        <b>Package Deals</b>
                                        <b>Fun</b>
                                        <b>People</b>
                                    </span>
                                    Waiting for You
                                </h2>
                            </div>
                        </div>
                        <!-- end hero-content -->

                        <div class="section-tab text-center ps-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="flight-tab"
                                        data-bs-toggle="tab" href="#flight" role="tab" aria-controls="flight"
                                        aria-selected="true">
                                        <i class="la la-plane me-1"></i>Flights
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="hotel-tab" data-bs-toggle="tab"
                                        href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">
                                        <i class="la la-hotel me-1"></i>Hotels
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="package-tab" data-bs-toggle="tab"
                                        href="#package" role="tab" aria-controls="package" aria-selected="false">
                                        <i class="la la-shopping-bag me-1"></i>Vacation Packages
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="car-tab" data-bs-toggle="tab"
                                        href="#car" role="tab" aria-controls="car" aria-selected="true">
                                        <i class="la la-car me-1"></i>Cars
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="cruise-tab" data-bs-toggle="tab"
                                        href="#cruise" role="tab" aria-controls="cruise" aria-selected="false">
                                        <i class="la la-ship me-1"></i>Cruises
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="tour-tab" data-bs-toggle="tab"
                                        href="#tour" role="tab" aria-controls="tour" aria-selected="false">
                                        <i class="la la-globe me-1"></i>Tours
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end section-tab -->

                        <div class="tab-content search-fields-container" id="myTabContent">
                            <div class="tab-pane fade show active" id="flight" role="tabpanel"
                                aria-labelledby="flight-tab">
                                <div class="section-tab section-tab-2 pb-3">
                                    <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="one-way-tab" data-bs-toggle="tab" href="#one-way"
                                                role="tab" aria-controls="one-way" aria-selected="true">
                                                One way
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="round-trip-tab" data-bs-toggle="tab" href="#round-trip"
                                                role="tab" aria-controls="round-trip" aria-selected="false">
                                                Round-trip
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end section-tab -->

                                <div class="tab-content" id="myTabContent3">
                                    <div class="tab-pane fade show active" id="one-way" role="tabpanel"
                                        aria-labelledby="one-way-tab">

                                        @livewire('flight.search-form', ['tripType' => 'one-way'])

                                    </div>
                                    <!-- end tab-pane -->
                                    <div class="tab-pane fade" id="round-trip" role="tabpanel"
                                        aria-labelledby="round-trip-tab">

                                        @livewire('flight.search-form', ['tripType' => 'round-trip'])
                                        <!-- end advanced-wrap -->
                                    </div>
                                    <!-- end tab-pane -->
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                                <div class="contact-form-action">
                                    <form action="#" class="row align-items-center">
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Destination / Hotel name</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter city or property" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Check in</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Check out</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3">
                                            <div class="input-box">
                                                <label class="label-text">Guests and Rooms</label>
                                                <div class="form-group">
                                                    <div class="dropdown dropdown-contain gty-container">
                                                        <a class="dropdown-toggle dropdown-btn" href="#"
                                                            role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false" data-bs-auto-close="outside">
                                                            <span class="adult" data-text="Adult"
                                                                data-text-multi="Adults">0
                                                                Adult</span>
                                                            -
                                                            <span class="children" data-text="Child"
                                                                data-text-multi="Children">0 Child</span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-wrap">
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Rooms</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="room_number"
                                                                            value="0" class="qty-input" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Adults</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="adult_number"
                                                                            value="0" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Children</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="child_number"
                                                                            value="0" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end dropdown -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                    </form>
                                </div>
                                <div class="btn-box">
                                    <a href="hotel-search-result.html" class="theme-btn">Search Now</a>
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane fade" id="package" role="tabpanel" aria-labelledby="package-tab">
                                <div class="section-tab section-tab-2 pb-3">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="flight-hotel-tab" data-bs-toggle="tab"
                                                href="#flight-hotel" role="tab" aria-controls="flight-hotel"
                                                aria-selected="true">
                                                Flight + Hotel
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="flight-hotel-car-tab" data-bs-toggle="tab"
                                                href="#flight-hotel-car" role="tab" aria-controls="flight-hotel-car"
                                                aria-selected="false">
                                                Flight + Hotel + Car
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="flight-car-tab" data-bs-toggle="tab"
                                                href="#flight-car" role="tab" aria-controls="flight-car"
                                                aria-selected="false">
                                                Flight + Car
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="hotel-car-tab" data-bs-toggle="tab"
                                                href="#hotel-car" role="tab" aria-controls="hotel-car"
                                                aria-selected="true">
                                                Hotel + Car
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end section-tab -->
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="flight-hotel" role="tabpanel"
                                        aria-labelledby="flight-hotel-tab">
                                        <div class="contact-form-action">
                                            <form action="#" class="row align-items-center">
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying from</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying to</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Departing - Returning</label>
                                                        <div class="form-group">
                                                            <span class="la la-calendar form-icon"></span>
                                                            <input class="date-range form-control" type="text"
                                                                name="daterange" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3">
                                                    <div class="input-box">
                                                        <label class="label-text">Guests and Rooms</label>
                                                        <div class="form-group">
                                                            <div class="dropdown dropdown-contain gty-container">
                                                                <a class="dropdown-toggle dropdown-btn" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" data-bs-auto-close="outside">
                                                                    <span class="adult" data-text="Adult"
                                                                        data-text-multi="Adults">0 Adult</span>
                                                                    -
                                                                    <span class="children" data-text="Child"
                                                                        data-text-multi="Children">0 Child</span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-wrap">
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Rooms</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="room_number"
                                                                                    value="0" class="qty-input" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Adults</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="adult_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Children</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="child_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end dropdown -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                            </form>
                                        </div>
                                        <div class="checkmark-wrap">
                                            <div class="custom-checkbox d-inline-block mb-0 me-3">
                                                <input type="checkbox" class="form-check-input" id="directFlightChb" />
                                                <label for="directFlightChb">Direct flights only</label>
                                            </div>
                                            <div class="custom-checkbox d-inline-block mb-0">
                                                <input type="checkbox" class="form-check-input" id="onlyHotelChb" />
                                                <label for="onlyHotelChb">I only need a hotel for part of my
                                                    stay</label>
                                            </div>
                                        </div>
                                        <!-- end checkmark-wrap -->
                                        <div class="btn-box pt-3">
                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->
                                    <div class="tab-pane fade" id="flight-hotel-car" role="tabpanel"
                                        aria-labelledby="flight-hotel-car-tab">
                                        <div class="contact-form-action">
                                            <form action="#" class="row align-items-center">
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying from</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input type="text" class="form-control"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying to</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Departing - Returning</label>
                                                        <div class="form-group">
                                                            <span class="la la-calendar form-icon"></span>
                                                            <input class="date-range form-control" type="text"
                                                                name="daterange" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3">
                                                    <div class="input-box">
                                                        <label class="label-text">Guests and Rooms</label>
                                                        <div class="form-group">
                                                            <div class="dropdown dropdown-contain gty-container">
                                                                <a class="dropdown-toggle dropdown-btn" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" data-bs-auto-close="outside">
                                                                    <span class="adult" data-text="Adult"
                                                                        data-text-multi="Adults">0 Adult</span>
                                                                    -
                                                                    <span class="children" data-text="Child"
                                                                        data-text-multi="Children">0 Child</span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-wrap">
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Rooms</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="room_number"
                                                                                    value="0" class="qty-input" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Adults</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="adult_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Children</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="child_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end dropdown -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                            </form>
                                        </div>
                                        <div class="checkmark-wrap">
                                            <div class="custom-checkbox d-inline-block mb-0 me-3">
                                                <input type="checkbox" class="form-check-input" id="directFlightChb2" />
                                                <label for="directFlightChb2">Direct flights only</label>
                                            </div>
                                            <div class="custom-checkbox d-inline-block mb-0">
                                                <input type="checkbox" class="form-check-input" id="onlyHotelChb2" />
                                                <label for="onlyHotelChb2">I only need a hotel for part of my
                                                    stay</label>
                                            </div>
                                        </div>
                                        <!-- end checkmark-wrap -->
                                        <div class="btn-box pt-3">
                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->
                                    <div class="tab-pane fade" id="flight-car" role="tabpanel"
                                        aria-labelledby="flight-car-tab">
                                        <div class="contact-form-action">
                                            <form action="#" class="row align-items-center">
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying from</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Flying to</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="City or airport" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Departing - Returning</label>
                                                        <div class="form-group">
                                                            <span class="la la-calendar form-icon"></span>
                                                            <input class="date-range form-control" type="text"
                                                                name="daterange" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="input-box">
                                                        <label class="label-text">Passengers</label>
                                                        <div class="form-group">
                                                            <div class="dropdown dropdown-contain gty-container">
                                                                <a class="dropdown-toggle dropdown-btn" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" data-bs-auto-close="outside">
                                                                    <span class="adult" data-text="Adult"
                                                                        data-text-multi="Adults">0 Adult</span>
                                                                    -
                                                                    <span class="children" data-text="Child"
                                                                        data-text-multi="Children">0 Child</span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-wrap">
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Rooms</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="room_number"
                                                                                    value="0" class="qty-input" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Adults</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="adult_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Children</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="child_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end dropdown -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- end row -->
                                        </div>
                                        <div class="checkmark-wrap">
                                            <div class="custom-checkbox d-inline-block mb-0">
                                                <input type="checkbox" class="form-check-input" id="directFlightChb3" />
                                                <label for="directFlightChb3">Direct flights only</label>
                                            </div>
                                        </div>
                                        <!-- end checkmark-wrap -->
                                        <div class="btn-box pt-3">
                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->
                                    <div class="tab-pane fade" id="hotel-car" role="tabpanel"
                                        aria-labelledby="hotel-car-tab">
                                        <div class="contact-form-action">
                                            <form action="#" class="row align-items-center">
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Going to</label>
                                                        <div class="form-group">
                                                            <span class="la la-map-marker form-icon"></span>
                                                            <input class="form-control" type="text"
                                                                placeholder="Enter City or property" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Check in - Check-out</label>
                                                        <div class="form-group">
                                                            <span class="la la-calendar form-icon"></span>
                                                            <input class="date-range form-control" type="text"
                                                                name="daterange" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3 pe-0">
                                                    <div class="input-box">
                                                        <label class="label-text">Room Type</label>
                                                        <div class="form-group select2-container-wrapper">
                                                            <div class="select-contain w-auto">
                                                                <select class="select-contain-select">
                                                                    <option value="0">Select Type</option>
                                                                    <option value="1">Single</option>
                                                                    <option value="2">Double</option>
                                                                    <option value="3">Triple</option>
                                                                    <option value="4">Quad</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                                <div class="col-lg-3">
                                                    <div class="input-box">
                                                        <label class="label-text">Guests and Rooms</label>
                                                        <div class="form-group">
                                                            <div class="dropdown dropdown-contain gty-container">
                                                                <a class="dropdown-toggle dropdown-btn" href="#"
                                                                    role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false" data-bs-auto-close="outside">
                                                                    <span class="adult" data-text="Adult"
                                                                        data-text-multi="Adults">0 Adult</span>
                                                                    -
                                                                    <span class="children" data-text="Child"
                                                                        data-text-multi="Children">0 Child</span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-wrap">
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Rooms</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="room_number"
                                                                                    value="0" class="qty-input" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Adults</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="adult_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div
                                                                            class="qty-box d-flex align-items-center justify-content-between">
                                                                            <label>Children</label>
                                                                            <div class="qtyBtn d-flex align-items-center">
                                                                                <div class="qtyDec">
                                                                                    <i class="la la-minus"></i>
                                                                                </div>
                                                                                <input type="text" name="child_number"
                                                                                    value="0" />
                                                                                <div class="qtyInc">
                                                                                    <i class="la la-plus"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end dropdown -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-3 -->
                                            </form>
                                        </div>
                                        <div class="btn-box pt-2">
                                            <a href="activity-search-result.html" class="theme-btn">Search Now</a>
                                        </div>
                                    </div>
                                    <!-- end tab-pane -->
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane fade" id="car" role="tabpanel" aria-labelledby="car-tab">
                                <div class="contact-form-action">
                                    <form action="#" class="row align-items-center">
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Picking up</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" type="text"
                                                        placeholder="City, airport or address" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Pick-up date</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4">
                                            <div class="input-box">
                                                <label class="label-text">Time</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="0100AM">1:00AM</option>
                                                            <option value="0900AM" selected>9:00AM</option>
                                                            <option value="0930AM">9:30AM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                    </form>
                                    <form action="#" class="row align-items-center">
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Drop-off</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" type="text"
                                                        placeholder="Same as pick-up" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Drop-off date</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4">
                                            <div class="input-box">
                                                <label class="label-text">Time</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="0830AM">8:30AM</option>
                                                            <option value="0900AM" selected>9:00AM</option>
                                                            <option value="0930AM">9:30AM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                    </form>
                                    <!-- end row -->
                                </div>
                                <div class="advanced-wrap">
                                    <a class="btn collapse-btn theme-btn-hover-gray font-size-15"
                                        data-bs-toggle="collapse" href="#collapseSix" role="button"
                                        aria-expanded="false" aria-controls="collapseSix">
                                        Advanced options <i class="la la-angle-down ms-1"></i>
                                    </a>
                                    <div class="pt-3 collapse" id="collapseSix">
                                        <div class="row">
                                            <div class="col-lg-3 pe-0">
                                                <div class="input-box">
                                                    <label class="label-text">Car type</label>
                                                    <div class="form-group select2-container-wrapper">
                                                        <div class="select-contain w-auto">
                                                            <select class="select-contain-select">
                                                                <option value="1">No preference</option>
                                                                <option value="2">Economy</option>
                                                                <option value="3">Compact</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col-lg-3 -->
                                            <div class="col-lg-3 pe-0">
                                                <div class="input-box">
                                                    <label class="label-text">Rental car company</label>
                                                    <div class="form-group select2-container-wrapper">
                                                        <div class="select-contain w-auto">
                                                            <select class="select-contain-select">
                                                                <option value="">No preference</option>
                                                                <option value="AC">ACE Rent A Car</option>
                                                                <option value="AD">
                                                                    Advantage Rent-A-Car
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col-lg-3 -->
                                            <div class="col-lg-3">
                                                <div class="input-box">
                                                    <label class="label-text">Discount code</label>
                                                    <div class="form-group select2-container-wrapper">
                                                        <div class="select-contain w-auto">
                                                            <select class="select-contain-select">
                                                                <option value="0">I don't have a code</option>
                                                                <option value="1">
                                                                    Corporate or contracted
                                                                </option>
                                                                <option value="2">
                                                                    Special or advertised
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col-lg-3 -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <!-- end advanced-wrap -->
                                <div class="btn-box pt-3">
                                    <a href="car-search-result.html" class="theme-btn">Search Now</a>
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane fade" id="cruise" role="tabpanel" aria-labelledby="cruise-tab">
                                <div class="contact-form-action">
                                    <form action="#" class="row align-items-center">
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Going to</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="">Select destination</option>
                                                            <optgroup label="Most Popular">
                                                                <option value="caribbean">Caribbean</option>
                                                                <option value="bahamas">Bahamas</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Departs as early as</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Departs as late as</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                        <div class="col-lg-3">
                                            <div class="input-box">
                                                <label class="label-text">Travelers in the cabin</label>
                                                <div class="form-group">
                                                    <div class="dropdown dropdown-contain gty-container">
                                                        <a class="dropdown-toggle dropdown-btn" href="#"
                                                            role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false" data-bs-auto-close="outside">
                                                            <span class="adult" data-text="Adult"
                                                                data-text-multi="Adults">0
                                                                Adult</span>
                                                            -
                                                            <span class="children" data-text="Child"
                                                                data-text-multi="Children">0 Child</span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-wrap">
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Adults</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="adult_number"
                                                                            value="0" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Children</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="child_number"
                                                                            value="0" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-item">
                                                                <div
                                                                    class="qty-box d-flex align-items-center justify-content-between">
                                                                    <label>Infants</label>
                                                                    <div class="qtyBtn d-flex align-items-center">
                                                                        <div class="qtyDec">
                                                                            <i class="la la-minus"></i>
                                                                        </div>
                                                                        <input type="text" name="infants_number"
                                                                            value="0" class="qty-input" />
                                                                        <div class="qtyInc">
                                                                            <i class="la la-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end dropdown -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-3 -->
                                    </form>
                                </div>
                                <div class="btn-box">
                                    <a href="cruise-search-result.html" class="theme-btn">Search Now</a>
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">
                                <div class="contact-form-action">
                                    <form action="#" class="row align-items-center">
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">Where would like to go?</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marker form-icon"></span>
                                                    <input class="form-control" type="text"
                                                        placeholder="Destination, city, or region" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4 pe-0">
                                            <div class="input-box">
                                                <label class="label-text">From</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                        <div class="col-lg-4">
                                            <div class="input-box">
                                                <label class="label-text">To</label>
                                                <div class="form-group">
                                                    <span class="la la-calendar form-icon"></span>
                                                    <input class="date-range form-control" type="text"
                                                        name="daterange-single" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-4 -->
                                    </form>
                                </div>
                                <div class="advanced-wrap">
                                    <a class="btn collapse-btn theme-btn-hover-gray font-size-15"
                                        data-bs-toggle="collapse" href="#collapseSeven" role="button"
                                        aria-expanded="false" aria-controls="collapseSeven">
                                        Advanced search <i class="la la-angle-down ms-1"></i>
                                    </a>
                                    <div class="pt-3 collapse" id="collapseSeven">
                                        <div class="slider-range-wrap">
                                            <div class="price-slider-amount padding-bottom-20px">
                                                <label for="amount" class="filter__label">Price Range</label>
                                                <input type="text" id="amount" class="amounts" />
                                            </div>
                                            <!-- end price-slider-amount -->
                                            <div id="slider-range"></div>
                                            <!-- end slider-range -->
                                        </div>
                                        <!-- end slider-range-wrap -->
                                        <div class="checkbox-wrap padding-top-30px">
                                            <h3 class="title font-size-15 pb-3">Tour Categories</h3>
                                            <div class="custom-checkbox d-inline-block me-4">
                                                <input type="checkbox" class="form-check-input" id="tourChb1" />
                                                <label for="tourChb1">Active Adventure Tours</label>
                                            </div>
                                            <div class="custom-checkbox d-inline-block me-4">
                                                <input type="checkbox" class="form-check-input" id="tourChb2" />
                                                <label for="tourChb2">Ecotourism</label>
                                            </div>
                                            <div class="custom-checkbox d-inline-block me-4">
                                                <input type="checkbox" class="form-check-input" id="tourChb3" />
                                                <label for="tourChb3">Escorted Tours</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-box pt-3">
                                    <a href="tour-search-result.html" class="theme-btn">Search Now</a>
                                </div>
                            </div>
                            <!-- end tab-pane -->
                        </div>

                    </div>
                    <!-- end col-lg-12 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
            </svg>
        </div>
    </section>
    <!-- end hero-wrapper -->
    <!-- ================================
                    END HERO-WRAPPER AREA
                ================================= -->

    <!-- ================================
                    START INFO AREA
                ================================= -->
    <section class="info-area info-bg padding-top-50px padding-bottom-50px text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="info-icon">
                            <i class="la la-bullhorn"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">You'll never roam alone</h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor
                            </p>
                        </div>
                        <!-- end info-content -->
                    </div>
                    <!-- end icon-box -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="icon-box margin-top-50px">
                        <div class="info-icon">
                            <i class="la la-globe"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">
                                A world of choice – anytime, anywhere
                            </h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor
                            </p>
                        </div>
                        <!-- end info-content -->
                    </div>
                    <!-- end icon-box -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="icon-box">
                        <div class="info-icon">
                            <i class="la la-thumbs-up"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">Peace of mind, wherever you wander</h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor
                            </p>
                        </div>
                        <!-- end info-content -->
                    </div>
                    <!-- end icon-box -->
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end info-area -->
    <!-- ================================
                    END INFO AREA
                ================================= -->

    <div class="section-block"></div>

    <!-- ================================
             START ROUND-TRIP AREA
             ================================= -->

    <livewire:homepage.popular-routes />


    <!-- end round-trip-flight -->
    <!-- ================================
                    END ROUND-TRIP AREA
                ================================= -->

    <!-- ================================
                    START HOTEL AREA
                ================================= -->

    <section class="hotel-area section-bg section-padding overflow-hidden padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2 class="sec__title line-height-55">
                            Most Popular Hotel <br />
                            Destinations
                        </h2>
                    </div>
                    <!-- end section-heading -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
            <div class="row padding-top-50px">
                <div class="col-lg-12">
                    <div class="hotel-card-wrap">
                        <div class="hotel-card-carousel carousel-action">
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img1.jpg" alt="hotel-img" />
                                    </a>
                                    <span class="badge">Bestseller</span>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">The Millennium Hilton New York</a>
                                    </h3>
                                    <p class="card-meta">124 E Huron St, New york</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img2.jpg" alt="hotel-img" />
                                    </a>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Best Western Grant Park Hotel</a>
                                    </h3>
                                    <p class="card-meta">124 E Huron St, Chicago</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$58.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img3.jpg" alt="hotel-img" />
                                    </a>
                                    <span class="badge">Featured</span>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Hyatt Regency Maui Resort & Spa</a>
                                    </h3>
                                    <p class="card-meta">200 Nohea Kai Dr, Lahaina, HI</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img4.jpg" alt="hotel-img" />
                                    </a>
                                    <span class="badge">Popular</span>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Four Seasons Resort Maui at Wailea</a>
                                    </h3>
                                    <p class="card-meta">3900 Wailea Alanui Drive, Kihei, HI</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img5.jpg" alt="hotel-img" />
                                    </a>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Ibis Styles London Heathrow</a>
                                    </h3>
                                    <p class="card-meta">272 Bath Road, Harlington, England</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img6.jpg" alt="hotel-img" />
                                    </a>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Hotel Europe Saint Severin Paris</a>
                                    </h3>
                                    <p class="card-meta">
                                        38-40 Rue Saint Séverin, Paris, Paris
                                    </p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img1.jpg" alt="hotel-img" />
                                    </a>
                                    <span class="badge">Bestseller</span>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">The Millennium Hilton New York</a>
                                    </h3>
                                    <p class="card-meta">124 E Huron St, New york</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                            <div class="card-item mb-0">
                                <div class="card-img">
                                    <a href="hotel-single.html" class="d-block">
                                        <img src="images/img2.jpg" alt="hotel-img" />
                                    </a>
                                    <div class="add-to-wishlist icon-element" data-bs-toggle="tooltip"
                                        data-placement="top" title="Bookmark">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Best Western Grant Park Hotel</a>
                                    </h3>
                                    <p class="card-meta">124 E Huron St, Chicago</p>
                                    <div class="card-rating">
                                        <span class="badge text-white">4.4/5</span>
                                        <span class="review__text">Average</span>
                                        <span class="rating__text">(30 Reviews)</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$58.00</span>
                                            <span class="price__text">Per night</span>
                                        </p>
                                        <a href="hotel-single.html" class="btn-text">See details<i
                                                class="la la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-item -->
                        </div>
                        <!-- end hotel-card-carousel -->
                    </div>
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </section>
    <!-- end hotel-area -->
    <!-- ================================
                    END HOTEL AREA
                ================================= -->

    <!-- ================================
                    START DESTINATION AREA
                ================================= -->

    {{-- <section class="destination-area section--padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2 class="sec__title">Top Visited Places</h2>
                        <p class="sec__desc pt-3">
                            Morbi convallis bibendum urna ut viverra Maecenas quis
                        </p>
                    </div>

                    <!-- end section-heading -->
                </div>
                <!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="btn-box btn--box text-end">
                        <a href="tour-grid.html" class="theme-btn">Discover More</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row padding-top-50px">
                <div class="col-lg-4">
                    <div class="card-item destination-card">
                        <div class="card-img">
                            <img src="{{ asset('guest/images/destination-img2.jpg') }}" alt="destination-img" />
                            <span class="badge">new york</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="tour-details.html">Main Street Park</a>
                            </h3>
                            <div class="card-rating d-flex align-items-center">
                                <span class="ratings d-flex align-items-center me-1">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star-o"></i>
                                    <i class="la la-star-o"></i>
                                </span>
                                <span class="rating__text">(70694 Reviews)</span>
                            </div>
                            <div class="card-price d-flex align-items-center justify-content-between">
                                <p class="tour__text">50 Tours</p>
                                <p>
                                    <span class="price__from">Price</span>
                                    <span class="price__num">$58.00</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-item -->
                    <div class="card-item destination-card">
                        <div class="card-img">
                            <img src="{{ asset('guest/images/destination-img3.jpg') }}" alt="destination-img" />
                            <span class="badge">chicago</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="tour-details.html">Chicago Cultural Center</a>
                            </h3>
                            <div class="card-rating d-flex align-items-center">
                                <span class="ratings d-flex align-items-center me-1">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star-o"></i>
                                </span>
                                <span class="rating__text">(70694 Reviews)</span>
                            </div>
                            <div class="card-price d-flex align-items-center justify-content-between">
                                <p class="tour__text">50 Tours</p>
                                <p>
                                    <span class="price__from">Price</span>
                                    <span class="price__num">$68.00</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-item -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="card-item destination-card">
                        <div class="card-img">
                            <img src="{{ asset('guest/images/destination-img4.jpg') }}" alt="destination-img" />
                            <span class="badge">Hong Kong</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="tour-details.html">Lugard Road Lookout</a>
                            </h3>
                            <div class="card-rating d-flex align-items-center">
                                <span class="ratings d-flex align-items-center me-1">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star-o"></i>
                                    <i class="la la-star-o"></i>
                                </span>
                                <span class="rating__text">(70694 Reviews)</span>
                            </div>
                            <div class="card-price d-flex align-items-center justify-content-between">
                                <p class="tour__text">150 Tours</p>
                                <p>
                                    <span class="price__from">Price</span>
                                    <span class="price__num">$79.00</span>
                                    <span class="price__num before-price">$89.00</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-item -->
                    <div class="card-item destination-card">
                        <div class="card-img">
                            <img src="{{ asset('guest/images/destination-img5.jpg') }}" alt="destination-img" />
                            <span class="badge">Las Vegas</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="tour-details.html">Planet Hollywood Resort</a>
                            </h3>
                            <div class="card-rating d-flex align-items-center">
                                <span class="ratings d-flex align-items-center me-1">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star-o"></i>
                                </span>
                                <span class="rating__text">(70694 Reviews)</span>
                            </div>
                            <div class="card-price d-flex align-items-center justify-content-between">
                                <p class="tour__text">50 Tours</p>
                                <p>
                                    <span class="price__from">Price</span>
                                    <span class="price__num">$88.00</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-item -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4">
                    <div class="card-item destination-card">
                        <div class="card-img">
                            <img src="{{ asset('guest/images/destination-img.jpg') }}" alt="destination-img" />
                            <span class="badge">Shanghai</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="tour-details.html">Oriental Pearl TV Tower</a>
                            </h3>
                            <div class="card-rating d-flex align-items-center">
                                <span class="ratings d-flex align-items-center me-1">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                                <span class="rating__text">(70694 Reviews)</span>
                            </div>
                            <div class="card-price d-flex align-items-center justify-content-between">
                                <p class="tour__text">50 Tours</p>
                                <p>
                                    <span class="price__from">Price</span>
                                    <span class="price__num">$58.00</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end card-item -->
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section> --}}
    <!-- end destination-area -->
    <!-- ================================
                    END DESTINATION AREA
                ================================= -->

    <!-- ================================
                       START TESTIMONIAL AREA
                ================================= -->

    <section class="testimonial-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h2 class="sec__title line-height-50">
                            What our customers are saying us?
                        </h2>
                        <p class="sec__desc padding-top-30px">
                            Morbi convallis bibendum urna ut viverra. Maecenas quis
                            consequat libero
                        </p>
                        <div class="btn-box padding-top-35px">
                            <a href="#" class="theme-btn">Explore All</a>
                        </div>
                    </div>
                    <!-- end section-heading -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-8">
                    <div class="testimonial-carousel carousel-action">
                        <div class="testimonial-card">
                            <div class="testi-desc-box">
                                <p class="testi__desc">
                                    Excepteur sint occaecat cupidatat non proident sunt in culpa
                                    officia deserunt mollit anim laborum sint occaecat cupidatat
                                    non proident. Occaecat cupidatat non proident des.
                                </p>
                            </div>
                            <div class="author-content d-flex align-items-center">
                                <div class="author-img">
                                    <img src="{{asset('guest/images/team8.jpg')}}" alt="testimonial image" />
                                </div>
                                <div class="author-bio">
                                    <h4 class="author__title">Leroy Bell</h4>
                                    <span class="author__meta">United States</span>
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- end testimonial-card -->
                        <div class="testimonial-card">
                            <div class="testi-desc-box">
                                <p class="testi__desc">
                                    Excepteur sint occaecat cupidatat non proident sunt in culpa
                                    officia deserunt mollit anim laborum sint occaecat cupidatat
                                    non proident. Occaecat cupidatat non proident des.
                                </p>
                            </div>
                            <div class="author-content d-flex align-items-center">
                                <div class="author-img">
                                    <img src="{{asset('guest/images/team9.jpg')}}" alt="testimonial image" />
                                </div>
                                <div class="author-bio">
                                    <h4 class="author__title">Richard Pam</h4>
                                    <span class="author__meta">Canada</span>
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- end testimonial-card -->
                        <div class="testimonial-card">
                            <div class="testi-desc-box">
                                <p class="testi__desc">
                                    Excepteur sint occaecat cupidatat non proident sunt in culpa
                                    officia deserunt mollit anim laborum sint occaecat cupidatat
                                    non proident. Occaecat cupidatat non proident des.
                                </p>
                            </div>
                            <div class="author-content d-flex align-items-center">
                                <div class="author-img">
                                    <img src="{{asset('guest/images/team10.jpg')}}" alt="testimonial image" />
                                </div>
                                <div class="author-bio">
                                    <h4 class="author__title">Luke Jacobs</h4>
                                    <span class="author__meta">Australia</span>
                                    <span class="ratings d-flex align-items-center">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- end testimonial-card -->
                    </div>
                    <!-- end testimonial-carousel -->
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end testimonial-area -->
    <!-- ================================
                       START TESTIMONIAL AREA
                ================================= -->

    <!-- ================================
                    START CTA AREA
                ================================= -->
    <section class="cta-area padding-top-100px padding-bottom-180px text-center">
        <div class="video-bg">
            <video autoplay loop>
                <source src="video/video-bg.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="sec__title text-white line-height-55">
                            Let us show you the world <br />
                            Discover our most popular destinations
                        </h2>
                    </div>
                    <!-- end section-heading -->
                    <div class="btn-box padding-top-35px">
                        <a href="become-local-expert.html" class="theme-btn border-0">Join with us</a>
                    </div>
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
        <svg class="cta-svg" viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M-31.31,170.22 C164.50,33.05 334.36,-32.06 547.11,196.88 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
    </section>
    <!-- end cta-area -->
    <!-- ================================
                    END CTA AREA
                ================================= -->
@endsection
