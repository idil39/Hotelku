@extends('layouts.guest')

@section('title','HOTEL ADIMULIA')

@section('content')

{{-- HERO --}}

<section class="hero py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">

                    HOTEL ADIMULIA

                </h1>

                <p class="lead mb-4">

                    Luxury Hotel dengan pelayanan terbaik,
                    kamar eksklusif, fasilitas premium,
                    dan pengalaman menginap yang tak terlupakan.

                </p>

                @guest

                    <a href="{{ route('login') }}"
                       class="btn btn-warning btn-lg">

                        Login Untuk Booking

                    </a>

                @else

                    @if(auth()->user()->role == 'customer')

                        <a href="{{ route('customer.booking.index') }}"
                           class="btn btn-warning btn-lg">

                            Booking Sekarang

                        </a>

                    @else

                        <a href="{{ route('admin.dashboard') }}"
                           class="btn btn-primary btn-lg">

                            Dashboard Admin

                        </a>

                    @endif

                @endguest

            </div>

            <div class="col-lg-6">

                <img
                    src="https://images.unsplash.com/photo-1566073771259-6a8506099945"
                    class="img-fluid rounded shadow">

            </div>

        </div>

    </div>

</section>

{{-- ================= ROOM ================= --}}

<section id="room" class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h6 class="text-warning fw-bold">

                OUR ROOMS

            </h6>

            <h2 class="fw-bold">

                Pilihan Kamar Terbaik

            </h2>

            <p class="text-muted">

                Nikmati pengalaman menginap yang nyaman dan mewah.

            </p>

        </div>

        <div class="row g-4">

            @forelse($rooms as $room)

                @php

                    $image = match(strtolower($room->roomType->name)) {

                        'standard' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',

                        'deluxe' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',

                        'suite' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',

                        default => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80',

                    };

                @endphp

                <div class="col-lg-4 col-md-6">

                    <div class="card border-0 shadow h-100 rounded-4 overflow-hidden">

                        <img
                            src="{{ $image }}"
                            class="card-img-top"
                            style="height:250px;object-fit:cover;">

                        <div class="card-body">

                            <h4 class="fw-bold">

                                {{ $room->roomType->name }}

                            </h4>

                            <p class="text-muted">

                                {{ Str::limit($room->roomType->description,100) }}

                            </p>

                            <h5 class="text-warning fw-bold">

                                Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                                <small class="text-secondary">

                                    / malam

                                </small>

                            </h5>

                            <div class="mt-4">

                                @guest

                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-warning w-100">

                                        Login Untuk Booking

                                    </a>

                                @else

                                    @if(auth()->user()->role=='customer')

                                        <a
                                            href="{{ route('customer.room.show',$room->id) }}"
                                            class="btn btn-warning w-100">

                                            Lihat Detail

                                        </a>

                                    @else

                                        <a
                                            href="{{ route('admin.rooms.index') }}"
                                            class="btn btn-primary w-100">

                                            Kelola Kamar

                                        </a>

                                    @endif

                                @endguest

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-info text-center">

                        Belum ada kamar tersedia.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

        </div>

    </div>

</section>

{{-- ================= CONTACT ================= --}}

<section id="contact" class="py-5">

    <div class="container text-center">

        <h6 class="text-warning fw-bold">
            CONTACT
        </h6>

        <h2 class="section-title mb-4">
            Hubungi Kami
        </h2>

        <p class="text-muted mb-5">
            Kami siap melayani Anda 24 jam.
        </p>

        <div class="row justify-content-center">

            <div class="col-md-3 mb-4">

                <i class="bi bi-telephone-fill fs-1 text-warning"></i>

                <h5 class="mt-3">
                    Telepon
                </h5>

                <p>
                    +62 812 3456 7890
                </p>

            </div>

            <div class="col-md-3 mb-4">

                <i class="bi bi-envelope-fill fs-1 text-warning"></i>

                <h5 class="mt-3">
                    Email
                </h5>

                <p>
                    hoteladimulia@gmail.com
                </p>

            </div>

            <div class="col-md-3 mb-4">

                <i class="bi bi-geo-alt-fill fs-1 text-warning"></i>

                <h5 class="mt-3">
                    Lokasi
                </h5>

                <p>
                    Medan, Indonesia
                </p>

            </div>

        </div>

    </div>

</section>

{{-- ================= FOOTER ================= --}}

<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <h3 class="text-warning">
                    HOTEL ADIMULIA
                </h3>

                <p class="text-light">
                    Luxury Hotel & Resort
                </p>

            </div>

            <div class="col-lg-6 text-lg-end">

                @guest

                    <a href="{{ route('login') }}" class="btn btn-warning">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-outline-light">
                        Register
                    </a>

                @else

                    @if(auth()->user()->role=='admin')

                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">
                            Dashboard Admin
                        </a>

                    @else

                        <a href="{{ route('customer.dashboard') }}" class="btn btn-warning">
                            Dashboard Saya
                        </a>

                    @endif

                    <form action="{{ route('logout') }}"
                          method="POST"
                          class="d-inline">

                        @csrf

                        <button class="btn btn-danger">

                            Logout

                        </button>

                    </form>

                @endguest

            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center text-light">

            © {{ date('Y') }} HOTEL ADIMULIA.
            All Rights Reserved.

        </div>

    </div>

</footer>

</body>
</html>