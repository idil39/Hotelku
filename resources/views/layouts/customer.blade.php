<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title','HOTEL ADIMULIA')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center"
           href="{{ route('customer.dashboard') }}">

            <i class="bi bi-building-fill fs-3 me-2"></i>

            <div>

                <div>HOTEL ADIMULIA</div>

                <small style="font-size:12px">

                    Hotel Management

                </small>

            </div>

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCustomer">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarCustomer">

            @auth

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active fw-bold' : '' }}"
                       href="{{ route('customer.dashboard') }}">

                        <i class="bi bi-speedometer2 me-1"></i>

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('customer.booking.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('customer.booking.index') }}">

                        <i class="bi bi-building me-1"></i>

                        Hotel

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('customer.history') ? 'active fw-bold' : '' }}"
                       href="{{ route('customer.history') }}">

                        <i class="bi bi-clock-history me-1"></i>

                        History

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('customer.payment.*') ? 'active fw-bold' : '' }}"
                       href="{{ route('customer.payment.index') }}">

                        <i class="bi bi-credit-card me-1"></i>

                        Payment

                    </a>

                </li>

            </ul>

            <div class="dropdown">

                <button class="btn btn-light dropdown-toggle"
                        data-bs-toggle="dropdown">

                    <i class="bi bi-person-circle"></i>

                    {{ auth()->user()->name }}

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a class="dropdown-item"
                           href="#">

                            <i class="bi bi-person"></i>

                            Profile

                        </a>

                    </li>

                    <li>

                        <hr class="dropdown-divider">

                    </li>

                    <li>

                        <form action="{{ route('logout') }}"
                              method="POST">

                            @csrf

                            <button class="dropdown-item text-danger">

                                <i class="bi bi-box-arrow-right"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

            @endauth

        </div>

    </div>

</nav>

<header class="bg-primary text-white py-5 shadow-sm">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1 class="fw-bold">

                    Selamat Datang,

                    {{ auth()->user()->name }}

                </h1>

                <p class="mb-4">

                    Temukan kamar terbaik dengan harga terbaik hanya di

                    <strong>HOTEL ADIMULIA</strong>

                </p>

                <a href="{{ route('customer.booking.index') }}"
                   class="btn btn-warning btn-lg">

                    <i class="bi bi-search"></i>

                    Booking Sekarang

                </a>

            </div>

            <div class="col-lg-5 text-center">

                <i class="bi bi-building-fill"
                   style="font-size:160px;opacity:.2;"></i>

            </div>

        </div>

    </div>

</header>

<div class="container py-5">

    @yield('content')

</div>

<footer class="bg-white border-top py-4">

    <div class="container text-center">

        <small class="text-muted">

            © {{ date('Y') }}

            HOTEL ADIMULIA

            <br>

            Hotel Management System

        </small>

    </div>

</footer>

</body>

</html>