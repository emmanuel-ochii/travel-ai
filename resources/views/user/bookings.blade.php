@extends('layouts.user')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Dashboard </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> Travel Ai</a></li>
                                <li class="breadcrumb-item active"> Dashboard </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title text-muted">Total Booked Flights</h4>
                            <h2 class="mt-3 mb-2"><b>8952</b>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body p-t-10">
                            <h4 class="card-title text-muted">Total Flight Reviewed</h4>
                            <h2 class="mt-3 mb-2"><b>8952</b>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
