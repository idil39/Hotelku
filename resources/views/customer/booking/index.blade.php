@extends('layouts.customer')

@section('title','Booking Hotel')

@section('content')

<div class="container py-5">


{{-- HEADER --}}

<div class="text-center mb-5">


<h1 class="fw-bold">

Pilih Kamar Terbaik

</h1>


<p class="text-muted">

Nikmati pengalaman menginap mewah bersama HOTEL ADIMULIA

</p>


</div>




<div class="row g-4">



@foreach($rooms as $room)


@php

$image = match(strtolower($room->roomType->name)) {

'standard' =>
'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',

'deluxe' =>
'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',

'suite' =>
'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',

default =>
'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80'

};


@endphp




<div class="col-lg-4 col-md-6">



<div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 room-card">



{{-- IMAGE --}}

<div class="position-relative">


<img
src="{{ $image }}"
class="w-100"
style="height:260px;object-fit:cover;">



<span class="position-absolute top-0 end-0 m-3 badge bg-success rounded-pill px-3 py-2">


<i class="bi bi-check-circle me-1"></i>

Available


</span>


</div>





{{-- BODY --}}

<div class="card-body p-4">



<div class="d-flex justify-content-between align-items-center mb-3">


<h4 class="fw-bold mb-0">

{{ $room->roomType->name }}

</h4>



<i class="bi bi-door-open fs-3 text-warning"></i>


</div>



<p class="text-muted">


Room Number :

<strong>

{{ $room->room_number }}

</strong>


</p>



<div class="mb-3">


<span class="text-muted">

Kapasitas

</span>


<br>


<i class="bi bi-people-fill text-primary"></i>


{{ $room->roomType->capacity }}

Orang



</div>




<div class="border-top pt-3">


<small class="text-muted">

Mulai dari

</small>



<h3 class="fw-bold text-warning">


Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}



<small class="text-muted fs-6">

/ malam

</small>


</h3>


</div>






<a href="{{ route('customer.booking.create',$room) }}"
class="btn btn-dark w-100 rounded-pill mt-3 py-2">


<i class="bi bi-calendar-check me-2"></i>


Booking Sekarang


</a>



</div>


</div>



</div>


@endforeach




</div>


</div>





<style>


.room-card{

transition:.3s;

}



.room-card:hover{

transform:translateY(-8px);

box-shadow:0 15px 35px rgba(0,0,0,.15)!important;

}



</style>


@endsection