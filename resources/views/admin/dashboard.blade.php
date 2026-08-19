@extends('layouts.admin')

@section('title', 'Dashboard Administrator')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">

        <div class="col-12">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body p-5 text-white"
                     style="background:linear-gradient(135deg,#0d6efd,#0dcaf0);">

                    <div class="row align-items-center">

                        <div class="col-lg-8">

                            <h2 class="fw-bold">

                                Selamat Datang,
                                {{ auth()->user()->name }}

                            </h2>

                            <p class="mb-0">

                                Selamat datang di
                                <strong>HOTEL ADIMULIA Management System</strong>.

                                Gunakan dashboard ini untuk mengelola
                                seluruh operasional hotel.

                            </p>

                        </div>

                        <div class="col-lg-4 text-end">

                            <i class="bi bi-building display-1"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <small class="text-muted">

                        Customer

                    </small>

                    <h2 class="fw-bold mt-2">

                        {{ $customers }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <small class="text-muted">

                        Room Type

                    </small>

                    <h2 class="fw-bold mt-2">

                        {{ $roomTypes }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <small class="text-muted">

                        Total Kamar

                    </small>

                    <h2 class="fw-bold mt-2">

                        {{ $rooms }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <small class="text-muted">

                        Total Booking

                    </small>

                    <h2 class="fw-bold mt-2">

                        {{ $bookings }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

        {{-- Grafik & Ringkasan --}}
    <div class="row">

        {{-- Grafik --}}
        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        Statistik HOTEL ADIMULIA

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="hotelChart" height="120"></canvas>

                </div>

            </div>

        </div>

        {{-- Ringkasan --}}
        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        Ringkasan Hotel

                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span>Room Type</span>

                        <strong class="text-primary">

                            {{ $roomTypes }}

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Kamar Tersedia</span>

                        <strong class="text-success">

                            {{ $availableRooms }}

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Kamar Terisi</span>

                        <strong class="text-danger">

                            {{ $occupiedRooms }}

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Booking Pending</span>

                        <strong class="text-warning">

                            {{ $pendingBookings }}

                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>Total Pendapatan</span>

                        <strong class="text-success">

                            Rp {{ number_format($income,0,',','.') }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

        {{-- Booking Terbaru & Quick Action --}}
    <div class="row">

        {{-- Booking Terbaru --}}
        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        Booking Terbaru

                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Kamar</th>
                                    <th>Check In</th>
                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($latestBookings as $booking)

                                <tr>

                                    <td>

                                        {{ $loop->iteration }}

                                    </td>

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

                                                <span class="badge bg-warning">

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

                                                <span class="badge bg-dark">

                                                    Check Out

                                                </span>

                                                @break

                                            @default

                                                <span class="badge bg-danger">

                                                    Cancelled

                                                </span>

                                        @endswitch

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5" class="text-center py-4">

                                        Belum ada booking.

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        {{-- Quick Action --}}
        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        Quick Action

                    </h5>

                </div>

                <div class="card-body d-grid gap-3">

                    <a href="{{ route('admin.room-types.index') }}"
                       class="btn btn-primary">

                        <i class="bi bi-door-open-fill"></i>

                        Kelola Tipe Kamar

                    </a>

                    <a href="{{ route('admin.rooms.index') }}"
                       class="btn btn-success">

                        <i class="bi bi-house-door-fill"></i>

                        Kelola Kamar

                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-warning">

                        <i class="bi bi-people-fill"></i>

                        Kelola Customer

                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                       class="btn btn-danger">

                        <i class="bi bi-file-earmark-pdf-fill"></i>

                        Laporan Hotel

                    </a>

                </div>

            </div>

        </div>

    </div>

        
</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('hotelChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Customer',

            'Room Type',

            'Rooms',

            'Booking'

        ],

        datasets: [{

            label: 'Statistik HOTEL ADIMULIA',

            data: @json($chartData),

            backgroundColor: [

                '#0d6efd',

                '#198754',

                '#ffc107',

                '#dc3545'

            ],

            borderRadius: 8,

            borderWidth: 0

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0

                }

            }

        }

    }

});

</script>

@endsection