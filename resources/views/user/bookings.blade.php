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
                                    My Bookings
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
                                <li>Dashboard</li>
                                <li> Booking</li>
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Type</th>
                                                <th scope="col">Route</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentFlights as $booking)
                                                <tr>
                                                    <th scope="row">
                                                        <i class="la la-plane me-1 font-size-18"></i>Flight
                                                    </th>

                                                    <td>
                                                        <div class="table-content">
                                                            <h3 class="title">
                                                                {{ $booking->flight->origin->name ?? 'Unknown' }}
                                                                →
                                                                {{ $booking->flight->destination->name ?? 'Unknown' }}
                                                            </h3>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{ $booking->flight->depart_at ? $booking->flight->depart_at->format('M d, Y') : '-' }}
                                                    </td>

                                                    <td>
                                                        ${{ number_format($booking->flight->base_price_cents / 100, 2) }}
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="badge
                    @if ($booking->status === 'confirmed') text-bg-success
                    @elseif($booking->status === 'pending') text-bg-info
                    @elseif($booking->status === 'cancelled') text-bg-danger
                    @else text-bg-secondary @endif
                    py-1 px-2">
                                                            {{ ucfirst($booking->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted py-3">
                                                        No recent flights found.
                                                    </td>
                                                </tr>
                                            @endforelse
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
                            {{ $recentFlights->links('pagination::bootstrap-5') }}
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
