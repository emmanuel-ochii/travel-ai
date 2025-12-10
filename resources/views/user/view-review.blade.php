@extends('layouts.user')

@section('content')
<div class="dashboard-content-wrap">
    <div class="dashboard-bread dashboard--bread">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title font-size-30 text-white">
                                {{ $review->airline ?? 'Property Name' }} {{ $review->booking->flight->flight_number ??
                                'N/A' }} Review
                            </h2>
                        </div>
                    </div>
                    <!-- end breadcrumb-content -->
                </div>
                <!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-end">
                        <ul class="list-items">
                            <li><a href="{{ route('dashboard') }}" class="text-white">Dashboard</a></li>
                            <li>Review</li>
                            <li> {{ $review->airline ?? 'Airline Name' }} {{ $review->booking->flight->flight_number ??
                                'N/A' }} </li>
                        </ul>
                    </div>
                    <!-- end breadcrumb-list -->
                </div>
                <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- end dashboard-bread -->
    <div class="dashboard-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Reviews</h3>
                        </div>
                        <div class="form-content">
                            <div class="comments-list">
                                <div class="comment">
                                    <div class="comment-avatar">
                                        {{-- Use the reviewer's avatar if available, otherwise a default image --}}
                                        <img class="avatar__img" alt="{{ $review->user->name ?? 'User' }}" src="{{ Auth::user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : asset('guest/images/avatar.png') }}" alt="{{ auth()->user()->name ?? 'User Avatar' }}" />
                                    </div>
                                    <div class="comment-body">
                                        <div class="meta-data">
                                            <h3 class="comment__author">
                                                {{ $review->airline ?? 'Property Name' }} {{
                                                $review->booking->flight->flight_number ?? 'N/A' }}
                                            </h3>
                                            <div class="meta-data-inner d-flex">
                                                <span class="ratings d-flex align-items-center me-1">
                                                    {{-- Display stars dynamically based on review rating --}}
                                                    @for ($i = 1; $i <= 5; $i++) <i
                                                        class="la la-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                        @endfor
                                                </span>
                                                <p class="comment__date">{{ $review->created_at->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                        <p class="comment-content mb-0">
                                            {{ $review->review_text }}
                                        </p>
                                    </div>
                                </div>
                                <!-- end comments -->
                            </div>

                            <!-- end comments-list -->
                        </div>
                    </div>
                    <!-- end form-box -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->

            <div class="border-top mt-5"></div>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="copy-right padding-top-30px">
                        <p class="copy__desc">
                            &copy; Copyright Travel AI <span id="get-year"></span>
                        </p>
                    </div>
                    <!-- end copy-right -->
                </div>
                <!-- end col-lg-7 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end dashboard-main-content -->
</div>
<!-- end dashboard-content-wrap -->
@endsection
