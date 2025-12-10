@extends('layouts.frontend')

@section('content')
    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area bread-bg-6">
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content text-center">
                            <div class="section-heading">
                                <h2 class="sec__title text-white">
                                    We appreciate your <br />
                                    feedback
                                </h2>
                            </div>
                        </div>
                        <!-- end breadcrumb-content -->
                    </div>
                    <!-- end col-lg-12 -->
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
        START FORM AREA
    ================================= -->
    {{-- <section class="listing-form section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="listing-header pb-4">
                        <h3 class="title font-size-28 pb-2">Review form submssion</h3>
                        <p class="font-size-14">
                            Kindly make a review of the flight history and your experience. <br /> Note: You can only make a
                            review of flight you have booked on our platform.
                        </p>
                    </div>


                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">
                                <i class="la la-plane me-2 text-gray"></i>Information about
                                your flight
                            </h3>
                        </div>
                        <!-- form-title-wrap -->
                        <div class="form-content contact-form-action">
                            <form method="post" class="row">
                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <label class="label-text">Total time of flight</label>
                                        <div class="form-group">
                                            <span class="la la-clock form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Total time of flight" />
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-lg-12 -->
                                <div class="col-lg-4">
                                    <div class="input-box">
                                        <label class="label-text"> Name </label>
                                        <div class="form-group">
                                            <span class="la la-user form-icon"></span>
                                            <input class="form-control" type="text" name="text"
                                                placeholder="Enter price" />
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-lg-6 -->
                                <div class="col-lg-4">
                                    <div class="input-box">
                                        <label class="label-text mb-0">Airline</label>
                                        <div class="form-group select2-container-wrapper select-contain w-100">
                                            <select class="select-contain-select">
                                                <option value="" selected>Advanced Air</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="input-box">
                                        <label class="label-text mb-0">Class Type</label>
                                        <div class="form-group select2-container-wrapper select-contain w-100">
                                            <select class="select-contain-select">
                                                <option value="" selected>First class</option>
                                                <option value="2">Business</option>
                                                <option value="3">Economy</option>
                                                <option value="4">Premium Economy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-lg-4 -->
                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <label class="label-text mb-0 line-height-20">Description of your experience </label>
                                        <p class="font-size-13 mb-3 line-height-20">
                                            400 character limit
                                        </p>
                                        <div class="form-group">
                                            <span class="la la-pencil form-icon"></span>
                                            <textarea class="message-control form-control" name="message"
                                                placeholder="In English only, no HTML, no web or email address, no ALL CAPS           "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col-lg-12 -->
                            </form>
                        </div>
                        <!-- end form-content -->
                    </div>
                    <!-- end form-box -->
                    <!-- end form-box -->
                    <div class="submit-box">
                        <h3 class="title pb-3">Submit this review</h3>
                        <div class="custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="agreeChb" />
                            <label for="agreeChb"> I confirm that i have given an honest review without bias. </label>
                        </div>
                        <div class="btn-box pt-3">
                            <button type="submit" class="theme-btn">
                                Submit Review <i class="la la-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                    <!-- end submit-box -->
                </div>
                <!-- end col-lg-9 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section> --}}
   @livewire('user.review-form', ['bookingId' => $booking->id])
    <!-- end listing-form -->
    <!-- ================================
        END FORM AREA
    ================================= -->
@endsection
