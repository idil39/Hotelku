@extends('layouts.admin')

@section('title','Booking Management')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-5">


<div>

<h2 class="fw-bold">

Booking Management

</h2>


<p class="text-muted mb-0">

Kelola seluruh reservasi HOTEL ADIMULIA

</p>


</div>



<a href="{{ route('admin.bookings.create') }}"

class="btn btn-warning rounded-pill px-4">


<i class="bi bi-plus-circle me-2"></i>

Booking Baru


</a>



</div>





@if(session('success'))

<div class="alert alert-success rounded-4">

{{ session('success') }}

</div>

@endif








<div class="row g-4">



@forelse($bookings as $booking)



<div class="col-xl-6">



<div class="card border-0 shadow-lg rounded-4 overflow-hidden">





<div class="card-body p-4">





<div class="d-flex justify-content-between align-items-start mb-4">



<div>


<h4 class="fw-bold mb-1">

{{ $booking->user->name }}

</h4>


<small class="text-muted">

Customer Booking

</small>


</div>





@if($booking->status=='confirmed')


<span class="badge bg-success rounded-pill px-3 py-2">

Confirmed

</span>



@elseif($booking->status=='pending')


<span class="badge bg-warning text-dark rounded-pill px-3 py-2">

Pending

</span>



@elseif($booking->status=='cancelled')


<span class="badge bg-danger rounded-pill px-3 py-2">

Cancelled

</span>



@else


<span class="badge bg-info rounded-pill px-3 py-2">

{{ ucfirst($booking->status) }}

</span>


@endif



</div>









<div class="row g-3">



<div class="col-md-6">


<div class="bg-light rounded-4 p-3">


<div class="text-muted small">

<i class="bi bi-door-open text-warning"></i>

Room

</div>


<h6 class="fw-bold mt-2 mb-0">

{{ $booking->room->room_number }}

</h6>


<small>

{{ $booking->room->roomType->name }}

</small>



</div>


</div>







<div class="col-md-6">


<div class="bg-light rounded-4 p-3">


<div class="text-muted small">

<i class="bi bi-people text-warning"></i>

Guest

</div>


<h6 class="fw-bold mt-2 mb-0">

{{ $booking->guest }}

Orang

</h6>



</div>


</div>








<div class="col-md-6">


<div class="bg-light rounded-4 p-3">


<div class="text-muted small">

<i class="bi bi-calendar-check text-warning"></i>

Check In

</div>


<h6 class="fw-bold mt-2 mb-0">

{{ $booking->check_in }}

</h6>



</div>


</div>








<div class="col-md-6">


<div class="bg-light rounded-4 p-3">


<div class="text-muted small">

<i class="bi bi-calendar-x text-warning"></i>

Check Out

</div>


<h6 class="fw-bold mt-2 mb-0">

{{ $booking->check_out }}

</h6>



</div>


</div>





</div>







<div class="mt-4 p-3 rounded-4"

style="background:#fff8e7;">



<div class="d-flex justify-content-between align-items-center">


<span class="fw-semibold">

Total Pembayaran

</span>



<h4 class="text-warning fw-bold mb-0">

Rp {{ number_format($booking->total_price,0,',','.') }}

</h4>



</div>


</div>








<div class="d-flex gap-2 mt-4">



<a href="{{ route('admin.bookings.edit',$booking) }}"

class="btn btn-outline-warning rounded-pill flex-fill">


<i class="bi bi-pencil-square me-1"></i>

Edit


</a>







<form

action="{{ route('admin.bookings.destroy',$booking) }}"

method="POST"

class="flex-fill">


@csrf

@method('DELETE')



<button

class="btn btn-outline-danger rounded-pill w-100"

onclick="return confirm('Hapus booking?')">


<i class="bi bi-trash me-1"></i>

Delete


</button>


</form>





</div>






</div>




</div>




</div>






@empty



<div class="col-12">


<div class="alert alert-info text-center rounded-4 py-5">


<i class="bi bi-calendar-x display-4"></i>


<h5 class="mt-3">

Tidak ada booking

</h5>


<p>

Belum ada data reservasi.

</p>


</div>


</div>



@endforelse



</div>







<div class="mt-5">

{{ $bookings->links() }}

</div>




</div>


@endsection