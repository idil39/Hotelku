@extends('layouts.admin')

@section('title','Kelola Kamar')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-5">


<div>

<h2 class="fw-bold">
Kelola Kamar
</h2>

<p class="text-muted">
Manajemen seluruh kamar HOTEL ADIMULIA
</p>

</div>


<a href="{{ route('admin.rooms.create') }}"
class="btn btn-warning rounded-pill px-4">


<i class="bi bi-plus-circle me-2"></i>

Tambah Kamar


</a>


</div>



@if(session('success'))

<div class="alert alert-success rounded-4">

{{ session('success') }}

</div>

@endif




<div class="row g-4">


@forelse($rooms as $room)



@php

$image = match(strtolower($room->roomType->name ?? '')) {


'standard' =>
'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80',


'deluxe' =>
'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=900&q=80',


'suite' =>
'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=80',


default =>
'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=900&q=80'


};

@endphp





<div class="col-xl-4 col-lg-6">


<div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">



<div class="position-relative">


<img

src="{{ $image }}"

class="w-100"

style="
height:250px;
object-fit:cover;
">


<div class="position-absolute top-0 end-0 m-3">


@if($room->status=='available')

<span class="badge bg-success rounded-pill px-3 py-2">

Available

</span>


@elseif($room->status=='booked')


<span class="badge bg-danger rounded-pill px-3 py-2">

Booked

</span>


@else


<span class="badge bg-warning text-dark rounded-pill px-3 py-2">

Maintenance

</span>


@endif


</div>


</div>





<div class="card-body p-4">


<h4 class="fw-bold">

{{ $room->roomType->name ?? '-' }}

</h4>



<div class="text-muted mb-3">

<i class="bi bi-door-open me-2"></i>

Nomor Kamar :

<strong>

{{ $room->room_number }}

</strong>

</div>




<hr>




<div class="d-flex justify-content-between">


<a href="{{ route('admin.rooms.edit',$room) }}"

class="btn btn-outline-warning rounded-pill px-4">


<i class="bi bi-pencil me-1"></i>

Edit


</a>





<form

action="{{ route('admin.rooms.destroy',$room) }}"

method="POST">


@csrf

@method('DELETE')


<button

class="btn btn-outline-danger rounded-pill px-4"

onclick="return confirm('Hapus kamar ini?')">


<i class="bi bi-trash me-1"></i>

Hapus


</button>


</form>


</div>



</div>



</div>


</div>



@empty



<div class="col-12">


<div class="alert alert-info text-center rounded-4 py-5">


<h4>

Belum ada kamar

</h4>


<p>

Silahkan tambahkan kamar baru.

</p>


</div>


</div>



@endforelse



</div>




<div class="mt-5">

{{ $rooms->links() }}

</div>



</div>


@endsection