@extends('layouts.guest')

@section('title', $room->roomType->name)

@section('content')

<section class="py-5 mt-5">

    <div class="container">

        <div class="row g-5">

            {{-- ================= IMAGE ================= --}}

            <div class="col-lg-7">

                @php

                    $image = match(strtolower($room->roomType->name)) {

                        'standard' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',

                        'deluxe' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',

                        'suite' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',

                        default => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80',

                    };

                @endphp

                <img
                    src="{{ $image }}"
                    class="img-fluid rounded-4 shadow-lg w-100"
                    style="height:520px;object-fit:cover;">

            </div>

            {{-- ================= INFORMATION ================= --}}

            <div class="col-lg-5">

                <span class="badge bg-warning text-dark px-3 py-2 mb-3">

                    {{ strtoupper($room->status) }}

                </span>

                <h1 class="fw-bold mb-3">

                    {{ $room->roomType->name }}

                </h1>

                <h3 class="text-warning mb-4">

                    Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                    <small class="fs-6 text-secondary">

                        / malam

                    </small>

                </h3>

                <p class="text-muted">

                    {{ $room->roomType->description }}

                </p>

                <hr>

                <div class="mb-3">

                    <strong>Nomor Kamar :</strong>

                    {{ $room->room_number }}

                </div>

                <div class="mb-3">

                    <strong>Kapasitas :</strong>

                    {{ $room->roomType->capacity }}

                    Orang

                </div>

                <div class="mb-4">

                    <strong>Fasilitas :</strong>

                    <div class="mt-2">

                        <span class="badge bg-light text-dark border me-2 mb-2">WiFi</span>

                        <span class="badge bg-light text-dark border me-2 mb-2">Breakfast</span>

                        <span class="badge bg-light text-dark border me-2 mb-2">Smart TV</span>

                        <span class="badge bg-light text-dark border me-2 mb-2">AC</span>

                        <span class="badge bg-light text-dark border me-2 mb-2">Bathroom</span>

                    </div>

                </div>

                @auth

                    @if(auth()->user()->role=='customer')

                        <a
                            href="{{ route('customer.booking.create',$room->id) }}"
                            class="btn btn-warning btn-lg rounded-pill px-5">

                            <i class="bi bi-calendar-check me-2"></i>

                            Booking Sekarang

                        </a>

                    @endif

                @else

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-warning btn-lg rounded-pill px-5">

                        Login Untuk Booking

                    </a>

                @endauth

            </div>

        </div>

    </div>

</section>

@endsection