@extends('layouts.user')

@push('styles')
    <style>
        .table tbody tr td,
        .table tbody tr th {
            padding-top: 15px;
            padding-bottom: 15px;
        }
    </style>
@endpush


@section('content')
    <!-- start dashboard-content-wrap -->
    <div class="dashboard-content-wrap">
        <div class="dashboard-bread">
            <div class="container-fluid">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title font-size-30 text-white">
                                    My Reviews
                                </h2>
                            </div>
                        </div>
                        <!-- end breadcrumb-content -->
                    </div>
                    <!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-end">
                            <ul class="list-items">
                                <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                                <li> Dashboard </li>
                                <li> Reviews </li>
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

        <div class="dashboard-main-content mt-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="title"> Recent Bookings </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="form-content">
                                <div class="table-form table-responsive">
                                    {{-- <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Flight Number </th>
                                                <th scope="col">Route</th>
                                                <th scope="col"> Order Date </th>
                                                <th scope="col"> Rating </th>
                                                <th scope="col"> Comment </th>
                                                <th scope="col"> Status </th>
                                                <th scope="col"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"></i>Flight DES123-43
                                                </th>

                                                <td>
                                                    <div class="table-content">
                                                        <h3 class="title"> New York -> Dubai </h3>
                                                    </div>
                                                </td>

                                                <td>OCT, 12 2025
                                                </td>

                                                <td>
                                                    <span class="ratings d-flex align-items-center me-1">
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                        <i class="la la-star"></i>
                                                    </span>
                                                </td>

                                                <td>
                                                    very comfortable flight...
                                                </td>


                                                <td>
                                                    <span class="badge text-bg-secondary text-white py-1 px-2"> Not Reviewed </span>
                                                </td>

                                                <td>
                                                    <div class="table-content">
                                                        <a href="#" class="theme-btn theme-btn-small me-2"
                                                            data-bs-toggle="tooltip" data-placement="top" aria-label="View"
                                                            data-bs-original-title="View"><i class="la la-eye"></i></a>
                                                        <a href="this_should_link_to_the_review_form" class="theme-btn theme-btn-small"
                                                            data-bs-toggle="tooltip" data-placement="top" aria-label="Edit"
                                                            data-bs-original-title="Give Review"><i class="la la-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table> --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Flight Number</th>
                                                <th>Route</th>
                                                <th>Order Date</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->flight->flight_number }}</td>

                                                    <td>
                                                        <div class="table-content">
                                                            <h3 class="title">
                                                                <h3 class="title"> {{ optional($booking->flight->origin)->name ?? 'Unknown' }} →
    {{ optional($booking->flight->destination)->name ?? 'Unknown' }} 
</h3>
                                                            </h3>
                                                        </div>
                                                    </td>

                                                    <td>{{ $booking->created_at->format('M d, Y') }}</td>

                                                    <td>
                                                        @if ($booking->review)
                                                            <span class="ratings d-flex align-items-center me-1">
                                                                @for ($i = 1; $i <= $booking->review->rating; $i++)
                                                                    <i class="la la-star"></i>
                                                                @endfor
                                                            </span>
                                                        @else
                                                            —
                                                        @endif
                                                    </td>

                                                    <td>{{ $booking->review->review_text ?? '—' }}</td>

                                                    <td>
                                                        @if ($booking->review)
                                                            <span
                                                                class="badge text-bg-success text-white py-1 px-2">Reviewed</span>
                                                        @elseif($booking->status === 'confirmed')
                                                            <span class="badge text-bg-secondary text-white py-1 px-2">Not
                                                                Reviewed</span>
                                                        @else
                                                            <span class="badge text-bg-warning text-white py-1 px-2">Pending
                                                                Payment</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="table-content">

                                                            @if ($booking->review)
                                                                <a href="{{ route('user.view.review', $booking->review->id) }}"
                                                                    class="theme-btn theme-btn-small me-2">
                                                                    <i class="la la-eye"></i>
                                                                </a>
                                                            @elseif($booking->status === 'confirmed')
                                                                <a href="{{ route('user.post.review', $booking->id) }}"
                                                                    class="theme-btn theme-btn-small">
                                                                    <i class="la la-edit"></i>
                                                                </a>
                                                            @else
                                                                <small class="text-muted">Unavailable</small>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end form-box -->
                    </div>
                    <!-- end col-lg-12 -->
                </div>
                <!-- end row -->

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation example">
                            {{-- {{ $recentFlights->links('pagination::bootstrap-5') }} --}}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end dashboard-main-content -->


    </div>
    <!-- end dashboard-content-wrap -->
@endsection
