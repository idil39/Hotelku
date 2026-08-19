<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>

        @yield('title','HOTEL ADIMULIA')

    </title>

    {{-- Google Font --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/hotel.css') }}">

</head>

<body>

{{-- ================= NAVBAR ================= --}}

<nav id="navbar"
     class="navbar navbar-expand-lg fixed-top">

    <div class="container">

        <a href="{{ url('/') }}"
           class="navbar-brand">

            HOTEL <span>ADIMULIA</span>

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">

            <i class="bi bi-list text-white fs-2"></i>

        </button>

        <div class="collapse navbar-collapse"
             id="menu">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a href="#home"
                       class="nav-link">

                        Home

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#about"
                       class="nav-link">

                        About

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#room"
                       class="nav-link">

                        Rooms

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#facility"
                       class="nav-link">

                        Facilities

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#gallery"
                       class="nav-link">

                        Gallery

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#contact"
                       class="nav-link">

                        Contact

                    </a>

                </li>

            </ul>

            {{-- ================= RIGHT MENU ================= --}}

            <div class="d-flex align-items-center">

                @guest

                    <a href="{{ route('login') }}"
                       class="btn btn-login">

                        Login

                    </a>

                    <a href="{{ route('register') }}"
                       class="btn btn-book ms-2">

                        Register

                    </a>

                @else

                    <div class="dropdown">

                        <button
                            class="btn btn-book dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle me-2"></i>

                            {{ auth()->user()->name }}

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            @if(auth()->user()->role=='admin')

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('admin.dashboard') }}">

                                        <i class="bi bi-speedometer2 me-2"></i>

                                        Dashboard Admin

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('admin.rooms.index') }}">

                                        <i class="bi bi-building me-2"></i>

                                        Kelola Kamar

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('admin.bookings.index') }}">

                                        <i class="bi bi-calendar-check me-2"></i>

                                        Data Booking

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('admin.payments.index') }}">

                                        <i class="bi bi-credit-card me-2"></i>

                                        Pembayaran

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('admin.reports.index') }}">

                                        <i class="bi bi-file-earmark-bar-graph me-2"></i>

                                        Laporan

                                    </a>

                                </li>

                            @else

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('customer.dashboard') }}">

                                        <i class="bi bi-speedometer2 me-2"></i>

                                        Dashboard

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('customer.booking.index') }}">

                                        <i class="bi bi-building me-2"></i>

                                        Booking Kamar

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('customer.history') }}">

                                        <i class="bi bi-clock-history me-2"></i>

                                        Riwayat Booking

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item"
                                       href="{{ route('customer.payment.index') }}">

                                        <i class="bi bi-credit-card me-2"></i>

                                        Pembayaran

                                    </a>

                                </li>

                            @endif

                            <li>

                                <hr class="dropdown-divider">

                            </li>

                            <li>

                                <form action="{{ route('logout') }}"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                @endguest

            </div>

        </div>

    </div>

</nav>

<main>

    @yield('content')

</main>

{{-- ================= BACK TO TOP ================= --}}

<button id="backToTop"
        class="back-to-top">

    <i class="bi bi-arrow-up"></i>

</button>

{{-- ================= LOADER ================= --}}

<div id="loader">

    <div class="spinner-border text-warning"
         role="status">

        <span class="visually-hidden">

            Loading...

        </span>

    </div>

</div>

{{-- ================= FOOTER ================= --}}

<footer id="contact" class="footer">

    <div class="container">

        <div class="row gy-5">

            <div class="col-lg-4">

                <h3 class="footer-logo">

                    HOTEL <span>ADIMULIA</span>

                </h3>

                <p>

                    HOTEL ADIMULIA menghadirkan pengalaman menginap
                    yang nyaman, elegan, dan berkelas dengan pelayanan
                    terbaik untuk setiap tamu.

                </p>

            </div>

            <div class="col-lg-2">

                <h5>

                    Menu

                </h5>

                <ul class="footer-links">

                    <li>

                        <a href="#home">

                            Home

                        </a>

                    </li>

                    <li>

                        <a href="#about">

                            About

                        </a>

                    </li>

                    <li>

                        <a href="#room">

                            Rooms

                        </a>

                    </li>

                    <li>

                        <a href="#facility">

                            Facilities

                        </a>

                    </li>

                    <li>

                        <a href="#gallery">

                            Gallery

                        </a>

                    </li>

                    <li>

                        <a href="#contact">

                            Contact

                        </a>

                    </li>

                </ul>

            </div>

            <div class="col-lg-3">

                <h5>

                    Kontak

                </h5>

                <p>

                    <i class="bi bi-geo-alt-fill me-2"></i>

                    Medan, Sumatera Utara

                </p>

                <p>

                    <i class="bi bi-envelope-fill me-2"></i>

                    info@hoteladimulia.com

                </p>

                <p>

                    <i class="bi bi-telephone-fill me-2"></i>

                    +62 812-3456-7890

                </p>

            </div>

            <div class="col-lg-3">

                <h5>

                    Akun

                </h5>

                @guest

                    <a href="{{ route('login') }}"
                       class="btn btn-warning w-100 mb-2">

                        Login

                    </a>

                    <a href="{{ route('register') }}"
                       class="btn btn-outline-light w-100">

                        Register

                    </a>

                @else

                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                           class="btn btn-warning w-100 mb-2">

                            Dashboard Admin

                        </a>

                    @else

                        <a href="{{ route('customer.dashboard') }}"
                           class="btn btn-warning w-100 mb-2">

                            Dashboard Customer

                        </a>

                    @endif

                    <form action="{{ route('logout') }}"
                          method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger w-100">

                            Logout

                        </button>

                    </form>

                @endguest

            </div>

        </div>

        <hr class="my-5">

        <div class="text-center">

            © {{ date('Y') }}

            HOTEL ADIMULIA.

            All Rights Reserved.

        </div>

    </div>

</footer>

{{-- ================= JAVASCRIPT ================= --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/hotel.js') }}"></script>

</body>

</html>

