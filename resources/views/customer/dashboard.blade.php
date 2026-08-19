@extends('layouts.customer')

@section('title','Dashboard Customer')

@section('content')

<div class="container py-4">


{{-- HERO HEADER --}}

<div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

    <div class="p-5 text-white"
         style="background:linear-gradient(135deg,#111827,#b8860b);">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h1 class="fw-bold">

                    Selamat Datang,
                    {{ auth()->user()->name }}

                </h1>


                <p class="mt-3 mb-0 fs-5">

                    Nikmati pengalaman menginap terbaik bersama
                    <strong>HOTEL ADIMULIA</strong>.
                    Kelola reservasi dan pembayaran Anda dengan mudah.

                </p>


            </div>


            <div class="col-md-4 text-center">

                <i class="bi bi-building-check"
                   style="font-size:100px;color:#ffd700;">
                </i>

            </div>


        </div>


    </div>

</div>




{{-- STATISTIC CARD --}}

<div class="row g-4 mb-4">


<div class="col-md-4">

<div class="card border-0 shadow rounded-4 h-100">

<div class="card-body p-4">


<div class="d-flex justify-content-between align-items-center">


<div>

<p class="text-muted mb-1">

Total Booking

</p>


<h2 class="fw-bold text-primary">

{{ auth()->user()->bookings()->count() }}

</h2>

</div>


<div class="rounded-circle bg-primary text-white p-3">

<i class="bi bi-calendar-check fs-3"></i>

</div>


</div>


</div>

</div>

</div>




<div class="col-md-4">


<div class="card border-0 shadow rounded-4 h-100">

<div class="card-body p-4">


<div class="d-flex justify-content-between">


<div>

<p class="text-muted mb-1">

Menunggu

</p>


<h2 class="fw-bold text-warning">

{{ auth()->user()->bookings()->where('status','pending')->count() }}

</h2>


</div>


<div class="rounded-circle bg-warning text-white p-3">

<i class="bi bi-hourglass-split fs-3"></i>

</div>


</div>


</div>

</div>


</div>





<div class="col-md-4">


<div class="card border-0 shadow rounded-4 h-100">


<div class="card-body p-4">


<div class="d-flex justify-content-between">


<div>


<p class="text-muted mb-1">

Selesai

</p>


<h2 class="fw-bold text-success">

{{ auth()->user()->bookings()->where('status','check_out')->count() }}

</h2>


</div>


<div class="rounded-circle bg-success text-white p-3">

<i class="bi bi-check-circle fs-3"></i>

</div>


</div>


</div>


</div>


</div>



</div>





{{-- BOOKING TERBARU --}}


<div class="card border-0 shadow-lg rounded-4 mb-4">


<div class="card-header border-0 text-white rounded-top-4"
style="background:#111827;">


<h5 class="mb-0">

<i class="bi bi-clock-history me-2"></i>

Booking Terbaru

</h5>


</div>



<div class="card-body p-4">


<div class="table-responsive">


<table class="table align-middle table-hover">


<thead class="table-light">


<tr>

<th>

Kamar

</th>

<th>

Check In

</th>

<th>

Check Out

</th>

<th>

Status

</th>

<th>

Total

</th>


</tr>


</thead>



<tbody>


@forelse(auth()->user()->bookings()->latest()->take(5)->get() as $booking)


<tr>


<td>


<div class="fw-bold">

{{ $booking->room->room_number }}

</div>


<small class="text-muted">

{{ $booking->room->roomType->name ?? '' }}

</small>


</td>



<td>

{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}

</td>



<td>

{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}

</td>



<td>


@switch($booking->status)


@case('pending')

<span class="badge bg-warning text-dark rounded-pill px-3">

Pending

</span>

@break



@case('confirmed')

<span class="badge bg-primary rounded-pill px-3">

Confirmed

</span>

@break



@case('check_in')

<span class="badge bg-success rounded-pill px-3">

Check In

</span>

@break



@case('check_out')

<span class="badge bg-secondary rounded-pill px-3">

Check Out

</span>

@break



@default

<span class="badge bg-danger rounded-pill px-3">

Cancelled

</span>


@endswitch


</td>




<td>


<strong class="text-success">

Rp {{ number_format($booking->total_price,0,',','.') }}

</strong>


</td>



</tr>


@empty


<tr>

<td colspan="5"
class="text-center py-4">


<i class="bi bi-calendar-x fs-1 text-muted"></i>


<p class="mt-2">

Belum ada booking

</p>


</td>

</tr>


@endforelse



</tbody>


</table>


</div>


</div>


</div>





{{-- INFORMATION --}}


<div class="card border-0 shadow rounded-4">


<div class="card-body p-4">


<div class="d-flex align-items-center mb-3">


<div class="bg-warning text-white rounded-circle p-3 me-3">


<i class="bi bi-info-circle fs-4"></i>


</div>


<h4 class="fw-bold mb-0">

Informasi Hotel

</h4>


</div>



<p class="text-muted">


Melalui dashboard ini Anda dapat melakukan booking kamar,
melihat riwayat reservasi, mengunggah bukti pembayaran,
dan memantau status menginap Anda di
<strong>HOTEL ADIMULIA</strong>.


</p>


</div>


</div>


</div>


@endsection