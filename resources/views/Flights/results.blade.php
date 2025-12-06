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

    {{-- <section class="hotel-area section-bg section-padding overflow-hidden padding-right-100px padding-left-100px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2 class="sec__title line-height-55">
                            Recommendations <br />
                            From Your Search
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
                                    <a href="flight-details" class="d-block">
                                        <img src="images/img1.jpg" alt="airline-img" />
                                    </a>
                                    <span class="badge">Cheaper</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="hotel-single.html">Airline_name</a>
                                    </h3>
                                    <p class="card-meta"> date_of_departure -> date_of_arrival </p>
                                    <div class="card-rating">
                                        <span class="badge text-white"> stops </span>
                                        <span class="review__text">Average</span>
                                    </div>
                                    <div class="card-price d-flex align-items-center justify-content-between">
                                        <p>
                                            <span class="price__from">From</span>
                                            <span class="price__num">$88.00</span>
                                        </p>
                                        <a href="flight_details_url" class="btn-text">See details<i
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
    </section> --}}

    @livewire('flight.recommended-carousel')

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
