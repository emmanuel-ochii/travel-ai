<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="TechyDevs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> Travel AI </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="{{ asset('guest/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/line-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/animated-headline.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('guest/css/style.css') }}" />


    @livewireStyles

    @stack('styles')

    <!-- Scripts -->
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- start cssload-loader -->
    {{-- <div class="preloader" id="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div> --}}
    <!-- end cssload-loader -->

    <!-- ================================
            START HEADER AREA
================================= -->
    <header class="header-area">
        <div class="header-top-bar padding-right-100px padding-left-100px">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="header-top-content">
                            <div class="header-left">
                                <ul class="list-items">
                                    <li>
                                        <a href="#"><i class="la la-phone me-1"></i>(123) 123-456</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="la la-envelope me-1"></i>info@travelai.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="header-top-content">
                            <div class="header-right d-flex align-items-center justify-content-end">
                                <div class="header-right-action">
                                    <div class="select-contain select--contain w-auto">
                                        <select class="select-contain-select">
                                            <option
                                                data-content='<span class="flag-icon flag-icon-us me-1"></span> English(US)'
                                                selected> English US </option>
                                            <option
                                                data-content='<span class="flag-icon flag-icon-gb-eng me-1"></span> English(UK)'>
                                                English UK
                                            </option>
                                            <option
                                                data-content='<span class="flag-icon flag-icon-ro me-1"></span> Romanian'>
                                                Romanian </option>
                                            <option
                                                data-content='<span class="flag-icon flag-icon-es me-1"></span> Español'>
                                                Español </option>
                                            <option
                                                data-content='<span class="flag-icon flag-icon-fr me-1"></span> Francais'>
                                                Francais </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="header-right-action">
                                    <div class="select-contain select--contain w-auto">
                                        <select class="select-contain-select">
                                            <option value="1">AED</option>
                                            <option value="2">AUD</option>
                                            <option value="3">BRL</option>
                                            <option value="4">CAD</option>
                                            <option value="24" selected>USD</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="header-right-action">
                                    <a href="#" class="theme-btn theme-btn-small theme-btn-transparent me-1"
                                        data-bs-toggle="modal" data-bs-target="#signupPopupForm">Sign Up</a>
                                    <a href="#" class="theme-btn theme-btn-small" data-bs-toggle="modal"
                                        data-bs-target="#loginPopupForm">Login</a>
                                </div> --}}
                                <div class="header-right-action">
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="theme-btn theme-btn-small">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('register') }}" class="theme-btn theme-btn-small theme-btn-transparent me-1">Sign Up</a>
                                        <a href="{{ route('login') }}" class="theme-btn">Login</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-menu-wrapper padding-right-100px padding-left-100px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-wrapper">
                            <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                            <div class="logo">
                                <a href="/"><img src="{{ asset('guest/images/rsz_travel-ai.png') }}"
                                        alt="logo" /></a>
                                <div class="menu-toggler">
                                    <i class="la la-bars"></i>
                                    <i class="la la-times"></i>
                                </div>
                                <!-- end menu-toggler -->
                            </div>
                            <!-- end logo -->
                            <div class="main-menu-content">
                                <nav>
                                    <ul>
                                        <li><a href="/"> Home </a></li>
                                        <li><a href="#"> Tour </a></li>
                                        <li><a href="#"> Cruise </i></a></li>
                                        <li><a href="#"> FAQs </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- end main-menu-content -->
                        </div>
                        <!-- end col-lg-12 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end header-menu-wrapper -->
    </header>
    <!-- ================================
         END HEADER AREA
================================= -->

    {{-- This will render Livewire OR Blade views safely --}}
    @isset($slot)
        {{ $slot }}
    @else
        @yield('content')
    @endisset


    <!-- ================================
       START FOOTER AREA
================================= -->
    <section class="footer-area section-bg padding-top-100px padding-bottom-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 responsive-column">
                    <div class="footer-item">
                        <div class="footer-logo padding-bottom-30px">
                            <a href="/" class="foot__logo"><img
                                    src="{{ asset('guest/images/rsz_travel-ai.png') }}" alt="logo" /></a>
                        </div>
                        <!-- end logo -->
                        <p class="footer__desc">
                            Morbi convallis bibendum urna ut viverra. Maecenas consequat
                        </p>
                        <ul class="list-items pt-3">
                            <li>
                                3015 Grand Ave, Coconut Grove,<br />
                                Cerrick Way, FL 12345
                            </li>
                            <li>+123-456-789</li>
                            <li><a href="#">trizen@yourwebsite.com</a></li>
                        </ul>
                    </div>
                    <!-- end footer-item -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column">
                    <div class="footer-item">
                        <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">
                            Company
                        </h4>
                        <ul class="list-items list--items">
                            <li><a href="about.html">About us</a></li>
                            <li><a href="services.html">Services</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="blog-grid.html">News</a></li>
                            <li><a href="contact.html">Support</a></li>
                            <li><a href="#">Advertising</a></li>
                        </ul>
                    </div>
                    <!-- end footer-item -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column">
                    <div class="footer-item">
                        <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">
                            Other Links
                        </h4>
                        <ul class="list-items list--items">
                            <li><a href="#">USA Vacation Packages</a></li>
                            <li><a href="#">USA Flights</a></li>
                            <li><a href="#">USA Hotels</a></li>
                            <li><a href="#">USA Car Hire</a></li>
                            <li><a href="#">Create an Account</a></li>
                            <li><a href="#">Trizen Reviews</a></li>
                        </ul>
                    </div>
                    <!-- end footer-item -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column">
                    <div class="footer-item">
                        <h4 class="title curve-shape pb-3 margin-bottom-20px" data-text="curvs">
                            Subscribe now
                        </h4>
                        <p class="footer__desc pb-3">
                            Subscribe for latest updates & promotions
                        </p>
                        <div class="contact-form-action">
                            <form action="#">
                                <div class="input-box">
                                    <label class="label-text">Enter email address</label>
                                    <div class="form-group mb-0">
                                        <span class="la la-envelope form-icon"></span>
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Email address" />
                                        <button class="theme-btn theme-btn-small submit-btn" type="submit">
                                            Go
                                        </button>
                                        <span class="font-size-14 pt-1"><i class="la la-lock me-1"></i>Your
                                            information
                                            is safe
                                            with us.</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end footer-item -->
                </div>
                <!-- end col-lg-3 -->
            </div>
            <!-- end row -->
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="term-box footer-item">
                        <ul class="list-items list--items d-flex align-items-center">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Help Center</a></li>
                        </ul>
                    </div>
                </div>
                <!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="footer-social-box text-end">
                        <ul class="social-profile">
                            <li>
                                <a href="#"><i class="lab la-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="lab la-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="lab la-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="lab la-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
        <div class="section-block mt-4"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="copy-right padding-top-30px">
                        <p class="copy__desc">
                            &copy; Copyright TravelAI <span id="get-year"></span>
                        </p>
                    </div>
                    <!-- end copy-right -->
                </div>
                <!-- end col-lg-7 -->
                <div class="col-lg-5">
                    <div class="copy-right-content d-flex align-items-center justify-content-end padding-top-30px">
                        <h3 class="title font-size-15 pe-2">We Accept</h3>
                        <img src="images/payment-img.png" alt="" />
                    </div>
                    <!-- end copy-right-content -->
                </div>
                <!-- end col-lg-5 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end footer-area -->
    <!-- ================================
       START FOOTER AREA
================================= -->

    <!-- start back-to-top -->
    <div id="back-to-top">
        <i class="la la-angle-up" title="Go top"></i>
    </div>
    <!-- end back-to-top -->

    <!-- end modal-shared -->
    <div class="modal-popup">
        <div class="modal fade" id="signupPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title title" id="exampleModalLongTitle">
                                Sign Up
                            </h5>
                            <p class="font-size-14">Hello! Welcome Create a New Account</p>
                        </div>
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form-action">
                            <form method="post">
                                <div class="input-box">
                                    <label class="label-text">Username</label>
                                    <div class="form-group">
                                        <span class="la la-user form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type your username" />
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Email Address</label>
                                    <div class="form-group">
                                        <span class="la la-envelope form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type your email" />
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Password</label>
                                    <div class="form-group">
                                        <span class="la la-lock form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type password" />
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Repeat Password</label>
                                    <div class="form-group">
                                        <span class="la la-lock form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type again password" />
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="btn-box pt-3 pb-4">
                                    <button type="button" class="theme-btn w-100">
                                        Register Account
                                    </button>
                                </div>
                                <div class="action-box text-center">
                                    <p class="font-size-14">Or Sign up Using</p>
                                    <ul class="social-profile py-3">
                                        <li>
                                            <a href="#" class="bg-5 text-white"><i
                                                    class="lab la-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-6 text-white"><i
                                                    class="lab la-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-7 text-white"><i
                                                    class="lab la-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-5 text-white"><i
                                                    class="lab la-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <!-- end contact-form-action -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal-popup -->

    <!-- end modal-shared -->
    <div class="modal-popup">
        <div class="modal fade" id="loginPopupForm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title title" id="exampleModalLongTitle2">
                                Login
                            </h5>
                            <p class="font-size-14">Hello! Welcome to your account</p>
                        </div>
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form-action">
                            <form method="post">
                                <div class="input-box">
                                    <label class="label-text">Username</label>
                                    <div class="form-group">
                                        <span class="la la-user form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type your username" />
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="input-box">
                                    <label class="label-text">Password</label>
                                    <div class="form-group mb-2">
                                        <span class="la la-lock form-icon"></span>
                                        <input class="form-control" type="text" name="text"
                                            placeholder="Type your password" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="custom-checkbox mb-0">
                                            <input type="checkbox" class="form-check-input" id="rememberchb" />
                                            <label for="rememberchb">Remember me</label>
                                        </div>
                                        <p class="forgot-password">
                                            <a href="recover.html">Forgot Password?</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- end input-box -->
                                <div class="btn-box pt-3 pb-4">
                                    <button type="button" class="theme-btn w-100">
                                        Login Account
                                    </button>
                                </div>
                                <div class="action-box text-center">
                                    <p class="font-size-14">Or Login Using</p>
                                    <ul class="social-profile py-3">
                                        <li>
                                            <a href="#" class="bg-5 text-white"><i
                                                    class="lab la-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-6 text-white"><i
                                                    class="lab la-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-7 text-white"><i
                                                    class="lab la-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-5 text-white"><i
                                                    class="lab la-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <!-- end contact-form-action -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal-popup -->

    @livewireScripts

    <!-- Template JS Files -->
    <script src="{{ asset('guest/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery-ui.js') }}"></script>

    <script src="{{ asset('guest/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('guest/js/select2.min.js') }}"></script>
    <script src="{{ asset('guest/js/moment.min.js') }}"></script>
    <script src="{{ asset('guest/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('guest/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.countTo.min.js') }}"></script>
    <script src="{{ asset('guest/js/animated-headline.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.ripples-min.js') }}"></script>
    <script src="{{ asset('guest/js/quantity-input.js') }}"></script>
    <script src="{{ asset('guest/js/main.js') }}"></script>

    @stack('scripts')
</body>


</html>
