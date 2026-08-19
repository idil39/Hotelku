@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Dashboard Administrator
        </h2>

        <p class="text-muted">
            Selamat datang di <strong>HOTEL ADIMULIA Management System</strong>.
            Kelola seluruh operasional hotel melalui dashboard ini.
        </p>

    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Room Type
                    </small>

                    <h2 class="fw-bold text-primary mt-2">
                        {{ $roomTypes }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Rooms
                    </small>

                    <h2 class="fw-bold text-success mt-2">
                        {{ $rooms }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Available Rooms
                    </small>

                    <h2 class="fw-bold text-warning mt-2">
                        {{ $availableRooms }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Occupied Rooms
                    </small>

                    <h2 class="fw-bold text-danger mt-2">
                        {{ $occupiedRooms }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Customer
                    </small>

                    <h2 class="fw-bold text-info mt-2">
                        {{ $customers }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Booking
                    </small>

                    <h2 class="fw-bold text-primary mt-2">
                        {{ $bookings }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Pending Booking
                    </small>

                    <h2 class="fw-bold text-warning mt-2">
                        {{ $pendingBookings }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Pendapatan
                    </small>

                    <h3 class="fw-bold text-success mt-2">
                        Rp {{ number_format($income,0,',','.') }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- Booking Terbaru --}}
    <div class="card border-0 shadow mb-4">

        <div class="card-header bg-white">

            <h4 class="fw-bold mb-0">

                Booking Terbaru

            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Customer</th>
                            <th>Room</th>
                            <th>Check In</th>
                            <th>Status</th>
                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($latestBookings as $booking)

                        <tr>

                            <td>

                                {{ $booking->user->name }}

                            </td>

                            <td>

                                {{ $booking->room->room_number }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}

                            </td>

                            <td>

                                @switch($booking->status)

                                    @case('pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @break

                                    @case('confirmed')

                                        <span class="badge bg-primary">
                                            Confirmed
                                        </span>

                                    @break

                                    @case('check_in')

                                        <span class="badge bg-success">
                                            Check In
                                        </span>

                                    @break

                                    @case('check_out')

                                        <span class="badge bg-secondary">
                                            Check Out
                                        </span>

                                    @break

                                    @default

                                        <span class="badge bg-danger">
                                            Cancelled
                                        </span>

                                @endswitch

                            </td>

                            <td>

                                Rp {{ number_format($booking->total_price,0,',','.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-4">

                                Belum ada data booking.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Informasi --}}
    <div class="card border-0 shadow">

        <div class="card-body">

            <h4 class="fw-bold mb-3">

                Selamat Datang 👋

            </h4>

            <p class="text-muted mb-0">

                Selamat datang di <strong>HOTEL ADIMULIA Management System</strong>.
                Gunakan menu di sebelah kiri untuk mengelola Room Type,
                Rooms, Facilities, Booking, Payment, Users, serta melihat
                Report secara cepat dan mudah.

            </p>

        </div>

    </div>

</div>

@endsection