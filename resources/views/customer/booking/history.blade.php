@extends('layouts.guest')

@section('title','Riwayat Booking')

@section('content')


<section class="py-5 mt-5">


<div class="container">


{{-- HEADER --}}

<div class="text-center mb-5">


<h1 class="fw-bold">

Riwayat Booking Saya

</h1>


<p class="text-muted">

Pantau semua reservasi Anda di HOTEL ADIMULIA

</p>


</div>




@if(session('success'))

<div class="alert alert-success rounded-4 shadow-sm">

<i class="bi bi-check-circle me-2"></i>

{{ session('success') }}

</div>

@endif





@if($bookings->count())



<div class="row g-4">



@foreach($bookings as $booking)



<div class="col-lg-6">



<div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">



{{-- HEADER CARD --}}

<div class="p-4 text-white"
style="background:linear-gradient(135deg,#111827,#b8860b);">


<div class="d-flex justify-content-between align-items-center">


<div>


<h4 class="fw-bold mb-1">


{{ $booking->room->roomType->name }}


</h4>


<small>

<i class="bi bi-door-open me-1"></i>

Room {{ $booking->room->room_number }}


</small>


</div>




<div>


<i class="bi bi-building"
style="font-size:45px;color:#ffd700">

</i>


</div>



</div>


</div>






<div class="card-body p-4">



<div class="row mb-3">


<div class="col-6">


<small class="text-muted">

Check In

</small>


<h6 class="fw-bold">

{{ $booking->check_in->format('d M Y') }}

</h6>


</div>



<div class="col-6">


<small class="text-muted">

Check Out

</small>


<h6 class="fw-bold">

{{ $booking->check_out->format('d M Y') }}

</h6>


</div>



</div>






<div class="d-flex justify-content-between mb-3">


<div>


<small class="text-muted">

Jumlah Tamu

</small>


<p class="fw-bold mb-0">


<i class="bi bi-people-fill text-primary"></i>


{{ $booking->guest }} Orang


</p>


</div>



<div class="text-end">


<small class="text-muted">

Total


</small>


<p class="fw-bold text-success mb-0">


Rp {{ number_format($booking->total_price,0,',','.') }}


</p>


</div>



</div>






<hr>




{{-- STATUS BOOKING --}}


<div class="d-flex justify-content-between align-items-center">


<div>


<small class="text-muted">

Status Booking

</small>


<br>


@if($booking->status=='pending')


<span class="badge bg-warning text-dark rounded-pill px-3">

<i class="bi bi-clock"></i>

Pending

</span>


@elseif($booking->status=='confirmed')


<span class="badge bg-success rounded-pill px-3">


<i class="bi bi-check-circle"></i>

Confirmed


</span>



@elseif($booking->status=='completed')


<span class="badge bg-primary rounded-pill px-3">


Completed


</span>



@else


<span class="badge bg-danger rounded-pill px-3">


Cancelled


</span>


@endif


</div>





<div>


@if(!$booking->payment)



<a href="{{ route('customer.payment.create',$booking->id) }}"
class="btn btn-warning rounded-pill px-4">


<i class="bi bi-wallet2 me-1"></i>


Bayar


</a>



@else



<a href="{{ route('customer.payment.show',$booking->payment->id) }}"
class="btn btn-success rounded-pill px-4">


<i class="bi bi-eye me-1"></i>


Lihat Pembayaran


</a>



@endif


</div>



</div>



</div>



</div>



</div>



@endforeach



</div>





<div class="mt-4">

{{ $bookings->links() }}

</div>




@else



<div class="card border-0 shadow rounded-4">


<div class="card-body text-center py-5">


<i class="bi bi-calendar-x display-3 text-muted"></i>


<h4 class="mt-3">


Belum Ada Booking


</h4>


<p class="text-muted">


Silakan pilih kamar terbaik untuk pengalaman menginap Anda.


</p>



</div>


</div>



@endif



</div>


</section>


@endsection