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
                                    My Profile
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
                                <li> Profile</li>
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
                            <div class="form-title-wrap border-bottom-0 pb-0">
                                <h3 class="title">Profile Information</h3>
                            </div>
                            <div class="form-content">
                                <div class="table-form table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="table-content">
                                                        <h3 class="title font-weight-medium">First Name</h3>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ explode(' ', $user->name)[0] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="table-content">
                                                        <h3 class="title font-weight-medium">Last Name</h3>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ explode(' ', $user->name)[1] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="table-content">
                                                        <h3 class="title font-weight-medium">Email Address</h3>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="table-content">
                                                        <h3 class="title font-weight-medium">Phone Number</h3>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="table-content">
                                                        <h3 class="title font-weight-medium">Address</h3>
                                                    </div>
                                                </td>
                                                <td>:</td>
                                                <td>{{ $user->address ?? 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="section-block"></div>
                                <div class="btn-box mt-4">
                                    <a href="#" class="theme-btn">Edit Profile</a>
                                </div>
                            </div>

                        </div>
                        <!-- end form-box -->
                    </div>
                    <!-- end col-lg-12 -->
                </div>
                <!-- end row -->

                @livewire('user.user-profile')
                <!-- end row -->

                <div class="border-top mt-4"></div>
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
