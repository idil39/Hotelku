@extends('layouts.admin')

@section('title','Room Type')

@section('content')


<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-5">


<div>

<h2 class="fw-bold">

Room Type

</h2>


<p class="text-muted mb-0">

Kelola tipe kamar HOTEL ADIMULIA

</p>


</div>



<a href="{{ route('admin.room-types.create') }}"

class="btn btn-warning rounded-pill px-4">


<i class="bi bi-plus-circle me-2"></i>

Tambah Room Type


</a>



</div>





@if(session('success'))

<div class="alert alert-success rounded-4">

{{ session('success') }}

</div>

@endif






<div class="row g-4">



@forelse($roomTypes as $roomType)



@php

$image = match(strtolower($roomType->name)) {


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
height:260px;
object-fit:cover;
">





<div class="position-absolute bottom-0 start-0 w-100 p-3"

style="
background:linear-gradient(
transparent,
rgba(0,0,0,.8)
);
">


<h3 class="text-white fw-bold mb-0">

{{ $roomType->name }}

</h3>


</div>



</div>








<div class="card-body p-4">





<p class="text-muted">

{{ $roomType->description ?? 'Kamar nyaman dengan fasilitas premium HOTEL ADIMULIA.' }}

</p>






<div class="d-flex justify-content-between align-items-center mb-3">



<div>


<small class="text-muted">

Harga / Malam

</small>


<h4 class="text-warning fw-bold mb-0">

Rp {{ number_format($roomType->price_per_night,0,',','.') }}

</h4>



</div>





<div class="text-end">


<small class="text-muted">

Kapasitas

</small>


<h5 class="fw-bold mb-0">

<i class="bi bi-people-fill text-warning"></i>

{{ $roomType->capacity }} Orang

</h5>



</div>



</div>







<hr>





<div class="d-flex gap-2">





<a href="{{ route('admin.room-types.edit',$roomType) }}"

class="btn btn-outline-warning rounded-pill flex-fill">


<i class="bi bi-pencil-square me-1"></i>

Edit


</a>








<form

action="{{ route('admin.room-types.destroy',$roomType) }}"

method="POST"

class="flex-fill">


@csrf

@method('DELETE')



<button

class="btn btn-outline-danger rounded-pill w-100"

onclick="return confirm('Yakin ingin menghapus data ini?')">


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


<i class="bi bi-building display-4"></i>


<h5 class="mt-3">

Belum ada Room Type

</h5>


<p>

Silahkan tambahkan tipe kamar baru.

</p>


</div>



</div>



@endforelse






</div>



</div>


@endsection