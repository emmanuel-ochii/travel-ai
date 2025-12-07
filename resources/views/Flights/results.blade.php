@extends('layouts.frontend')

@section('content')
    <!-- ================================
                START BREADCRUMB AREA
            ================================= -->
    <section class="breadcrumb-area bread-bg-6">
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title text-white">Flight Results</h2>
                            </div>
                        </div>
                        <!-- end breadcrumb-content -->
                    </div>
                    <!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-end">
                            <ul class="list-items">
                                <li><a href="/">Home</a></li>
                                <li>Flight</li>
                                <li>Result</li>
                            </ul>
                        </div>
                        <!-- end breadcrumb-list -->
                    </div>
                    <!-- end col-lg-6 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end breadcrumb-wrap -->
        <div class="bread-svg-box">
            <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
            </svg>
        </div>
        <!-- end bread-svg -->
    </section>
    <!-- end breadcrumb-area -->
    <!-- ================================
                END BREADCRUMB AREA
            ================================= -->

    <!-- ================================
                START CARD AREA
            ================================= -->
    <section class="card-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-wrap margin-bottom-30px">
                        <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                            <div>
                                <h3 class="title font-size-24">24 Flights found</h3>
                                <p class="font-size-14">
                                    <span class="me-1 pt-1">Book with confidence:</span>No
                                    flight booking fees
                                </p>
                            </div>
                            <div class="layout-view d-flex align-items-center">
                                <a href="flight-grid.html" data-bs-toggle="tooltip" data-placement="top" title="Grid View"
                                    class="active"><i class="la la-th-large"></i></a>
                                <a href="flight-list.html" data-bs-toggle="tooltip" data-placement="top"
                                    title="List View"><i class="la la-th-list"></i></a>
                            </div>
                        </div>
                        <!-- end filter-top -->

                        <div class="filter-bar d-flex align-items-center justify-content-between">
                            <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                                <div class="filter-option">
                                    <h3 class="title font-size-16">Filter by:</h3>
                                </div>
                                <div class="filter-option">
                                    <div class="dropdown dropdown-contain">
                                        <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            Filter Price
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-wrap">
                                            <div class="dropdown-item">
                                                <div class="slider-range-wrap">
                                                    <div class="price-slider-amount padding-bottom-20px">
                                                        <label for="amount" class="filter__label">Price:</label>
                                                        <input type="text" id="amount" class="amounts" />
                                                    </div>
                                                    <!-- end price-slider-amount -->
                                                    <div id="slider-range"></div>
                                                    <!-- end slider-range -->
                                                </div>
                                                <!-- end slider-range-wrap -->
                                                <div class="btn-box pt-4">
                                                    <button class="theme-btn theme-btn-small theme-btn-transparent"
                                                        type="button">
                                                        Apply
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- end dropdown-item -->
                                        </div>
                                        <!-- end dropdown-menu -->
                                    </div>
                                    <!-- end dropdown -->
                                </div>

                                <div class="filter-option">
                                    <div class="dropdown dropdown-contain">
                                        <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            Airlines
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-wrap">
                                            <div class="dropdown-item">
                                                <div class="checkbox-wrap">
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="catChb1" />
                                                        <label for="catChb1">Major Airlines</label>
                                                    </div>
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="catChb2" />
                                                        <label for="catChb2">United Airlines</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end dropdown-item -->
                                        </div>
                                        <!-- end dropdown-menu -->
                                    </div>
                                    <!-- end dropdown -->
                                </div>
                            </div>
                            <!-- end filter-bar-filter -->
                            <div class="select-contain select2-container-wrapper">
                                <select class="select-contain-select">
                                    <option value="1">Short by default</option>
                                    <option value="2">Popular Flight</option>
                                    <option value="3">Price: low to high</option>
                                    <option value="4">Price: high to low</option>
                                    <option value="5">A to Z</option>
                                </select>
                            </div>
                            <!-- end select-contain -->
                        </div>
                        <!-- end filter-bar -->
                    </div>
                    <!-- end filter-wrap -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->

            @livewire('flight.results')

            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-box mt-3 text-center">
                        <button type="button" class="theme-btn">
                            <i class="la la-refresh me-1"></i>Load More
                        </button>
                        <p class="font-size-13 pt-2">Showing 1 - 6 of 24 Flights</p>
                    </div>
                    <!-- end btn-box -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end card-area -->
    <!-- ================================
                END CARD AREA
            ================================= -->

    <div class="section-block"></div>

    @livewire('flight.recommended-carousel')


    <!-- ================================
        START BOOKING AREA
    ================================= -->
    <section class="booking-area padding-top-100px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Booking Submission</h3>
                        </div>
                        <!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">First Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" name="text"
                                                        placeholder="First name" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Last Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" name="text"
                                                        placeholder="Last name" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Your Email</label>
                                                <div class="form-group">
                                                    <span class="la la-envelope-o form-icon"></span>
                                                    <input class="form-control" type="email" name="email"
                                                        placeholder="Email address" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Phone Number</label>
                                                <div class="form-group">
                                                    <span class="la la-phone form-icon"></span>
                                                    <input class="form-control" type="text" name="text"
                                                        placeholder="Phone Number" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <div class="col-lg-12 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Address Line</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marked form-icon"></span>
                                                    <input class="form-control" type="text" name="text"
                                                        placeholder="Address line" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-12 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Country</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="select-country">
                                                                Select country
                                                            </option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Country Code</label>
                                                <div class="form-group select2-container-wrapper">
                                                    <div class="select-contain w-auto">
                                                        <select class="select-contain-select">
                                                            <option value="country-code">
                                                                Select country code
                                                            </option>
                                                            <option value="1">United Kingdom (+44)</option>
                                                            <option value="2">United States (+1)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-lg-6 -->
                                        <!-- end col-lg-12 -->
                                    </div>
                                </form>
                            </div>
                            <!-- end contact-form-action -->
                        </div>
                        <!-- end form-content -->
                    </div>
                    <!-- end form-box -->
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Your Card Information</h3>
                        </div>
                        <!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="section-tab check-mark-tab text-center pb-4">
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="credit-card-tab" data-bs-toggle="tab"
                                            href="#credit-card" role="tab" aria-controls="credit-card"
                                            aria-selected="false">
                                            <i class="la la-check icon-element"></i>
                                            <img src="{{asset('guest/images/payment-img.png')}}" alt="" />
                                            <span class="d-block pt-2">Payment with credit card</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="paypal-tab" data-bs-toggle="tab" href="#paypal"
                                            role="tab" aria-controls="paypal" aria-selected="true">
                                            <i class="la la-check icon-element"></i>
                                            <img src="{{asset('guest/images/paypal.png')}}" alt="" />
                                            <span class="d-block pt-2">Payment with PayPal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="payoneer-tab" data-bs-toggle="tab" href="#payoneer"
                                            role="tab" aria-controls="payoneer" aria-selected="true">
                                            <i class="la la-check icon-element"></i>
                                            <img src="{{asset('guest/images/bank_transfer.png')}}" alt="" />
                                            <span class="d-block pt-2">Payment with Bank Transfer</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end section-tab -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="credit-card" role="tabpanel"
                                    aria-labelledby="credit-card-tab">
                                    <div class="contact-form-action">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Card Holder Name</label>
                                                        <div class="form-group">
                                                            <span class="la la-credit-card form-icon"></span>
                                                            <input class="form-control" type="text" name="text"
                                                                placeholder="Card holder name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Card Number</label>
                                                        <div class="form-group">
                                                            <span class="la la-credit-card form-icon"></span>
                                                            <input class="form-control" type="text" name="text"
                                                                placeholder="Card number" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Expiry Month</label>
                                                                <div class="form-group">
                                                                    <span class="la la-credit-card form-icon"></span>
                                                                    <input class="form-control" type="text"
                                                                        name="text" placeholder="MM" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Expiry Year</label>
                                                                <div class="form-group">
                                                                    <span class="la la-credit-card form-icon"></span>
                                                                    <input class="form-control" type="text"
                                                                        name="text" placeholder="YY" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">CVV</label>
                                                        <div class="form-group">
                                                            <span class="la la-pencil form-icon"></span>
                                                            <input class="form-control" type="text" name="text"
                                                                placeholder="CVV" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-12">
                                                    <div class="input-box">
                                                        <div class="form-group">
                                                            <div class="custom-checkbox">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="agreechb" />
                                                                <label for="agreechb">By continuing, you agree to the
                                                                    <a href="#">Terms and Conditions</a>.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-12 -->
                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">
                                                            Confirm Booking
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end contact-form-action -->
                                </div>
                                <!-- end tab-pane-->
                                <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                                    <div class="contact-form-action">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Email Address</label>
                                                        <div class="form-group">
                                                            <span class="la la-envelope form-icon"></span>
                                                            <input class="form-control" type="email" name="email"
                                                                placeholder="Enter email address" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Password</label>
                                                        <div class="form-group">
                                                            <span class="la la-lock form-icon"></span>
                                                            <input class="form-control" type="text" name="text"
                                                                placeholder="Enter password" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">
                                                            Login Account
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end contact-form-action -->
                                </div>
                                <!-- end tab-pane-->
                                <div class="tab-pane fade" id="payoneer" role="tabpanel"
                                    aria-labelledby="payoneer-tab">
                                    <div class="contact-form-action">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Bank Name</label>
                                                        <h3>BANK NAME HERE</h3>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Account name</label>
                                                       <h4>Account name</h4>

                                                    </div>
                                                </div>
                                                <!-- end col-lg-6 -->
                                                <div class="col-lg-12">
                                                    <div class="btn-box">
                                                        <button class="theme-btn" type="submit">
                                                           I confirm i have made the transfer
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- end col-lg-12 -->
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end contact-form-action -->
                                </div>
                                <!-- end tab-pane-->
                            </div>
                            <!-- end tab-content -->
                        </div>
                        <!-- end form-content -->
                    </div>
                    <!-- end form-box -->
                </div>
                <!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="form-box booking-detail-form">
                        <div class="form-title-wrap">
                            <h3 class="title">Your Booking</h3>
                        </div>
                        <!-- end form-title-wrap -->
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                <div class="card-img pb-4">
                                     <img src="airline_logo_here" alt="room-img" />
                                </div>
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3 class="card-title">Airline_name and Flight_number</h3>
                                        </div>
                                    </div>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 list-items-flush py-2">
                                        <li class="font-size-15">
                                            <span class="w-auto d-block mb-n1"><i
                                                    class="la la-calendar me-1 font-size-17"></i>From: Origin</span>12 May 2020
                                            7:40am
                                        </li>
                                        <li class="font-size-15">
                                            <span class="w-auto d-block mb-n1"><i
                                                    class="la la-calendar me-1 font-size-17"></i>To: Destination</span>16 May 2020
                                            8:40am
                                        </li>
                                    </ul>
                                    <h3 class="card-title pb-3">Order Details</h3>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 py-3">
                                        <li><span>Class Type:</span>Economy</li>
                                        <li><span>Adults:</span>1</li>
                                        <li><span>Children:</span>1</li>
                                        <li><span>Infants:</span>2 </li>
                                    </ul>
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 pt-3">
                                        <li><span>Sub Total:</span>$240</li>
                                        <li><span>Taxes And Fees:</span>$5</li>
                                        <li><span>Total Price:</span>$245</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end card-item -->
                        </div>
                        <!-- end form-content -->
                    </div>
                    <!-- end form-box -->
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end booking-area -->
    <!-- ================================
        END BOOKING AREA
    ================================= -->


    <!-- ================================
                START INFO AREA
            ================================= -->
    <section class="info-area info-bg padding-top-90px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 responsive-column">
                    <a href="#" class="icon-box icon-layout-2 d-flex">
                        <div class="info-icon flex-shrink-0 bg-rgb text-color-2">
                            <i class="la la-phone"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">Need Help? Contact us</h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>
                        </div>
                        <!-- end info-content -->
                    </a><!-- end icon-box -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column">
                    <a href="#" class="icon-box icon-layout-2 d-flex">
                        <div class="info-icon flex-shrink-0 bg-rgb-2 text-color-3">
                            <i class="la la-money"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">Payments</h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>
                        </div>
                        <!-- end info-content -->
                    </a><!-- end icon-box -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column">
                    <a href="#" class="icon-box icon-layout-2 d-flex">
                        <div class="info-icon flex-shrink-0 bg-rgb-3 text-color-4">
                            <i class="la la-times"></i>
                        </div>
                        <!-- end info-icon-->
                        <div class="info-content">
                            <h4 class="info__title">Cancel Policy</h4>
                            <p class="info__desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                            </p>
                        </div>
                        <!-- end info-content -->
                    </a><!-- end icon-box -->
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
@endsection
