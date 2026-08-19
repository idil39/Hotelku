@extends('layouts.admin')

@section('title','Kelola Fasilitas')

@section('content')

<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-5">


<div>

<h2 class="fw-bold">

Kelola Fasilitas

</h2>


<p class="text-muted mb-0">

Fasilitas premium HOTEL ADIMULIA

</p>


</div>



<a href="{{ route('admin.facilities.create') }}"

class="btn btn-warning rounded-pill px-4">


<i class="bi bi-plus-circle me-2"></i>

Tambah Fasilitas


</a>



</div>





@if(session('success'))

<div class="alert alert-success rounded-4">

{{ session('success') }}

</div>

@endif







<div class="row g-4">



@forelse($facilities as $facility)



@php


$icon = match(true){


str_contains(strtolower($facility->name),'pool')
=> 'bi-water',


str_contains(strtolower($facility->name),'swim')
=> 'bi-water',


str_contains(strtolower($facility->name),'gym')
=> 'bi-heart-pulse',


str_contains(strtolower($facility->name),'fitness')
=> 'bi-heart-pulse',


str_contains(strtolower($facility->name),'restaurant')
=> 'bi-cup-hot',


str_contains(strtolower($facility->name),'food')
=> 'bi-cup-hot',


str_contains(strtolower($facility->name),'wifi')
=> 'bi-wifi',


str_contains(strtolower($facility->name),'parking')
=> 'bi-car-front',


str_contains(strtolower($facility->name),'spa')
=> 'bi-flower1',


str_contains(strtolower($facility->name),'meeting')
=> 'bi-people-fill',


default
=> 'bi-stars'


};


@endphp







<div class="col-xl-4 col-lg-6">



<div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">





<div class="position-relative">



@if($facility->image)


<img

src="{{ asset('storage/'.$facility->image) }}"

class="w-100"

style="
height:240px;
object-fit:cover;
">


@else



<div

class="d-flex justify-content-center align-items-center bg-light"

style="
height:240px;
">


<i class="bi {{ $icon }} text-warning"

style="font-size:90px;"></i>


</div>



@endif






<div class="position-absolute top-0 end-0 m-3">


<span class="badge bg-dark rounded-pill px-3 py-2">

<i class="bi {{ $icon }} me-1"></i>

Facility

</span>


</div>




</div>








<div class="card-body p-4">



<div class="d-flex align-items-center mb-3">



<div class="rounded-circle bg-warning-subtle p-3 me-3">


<i class="bi {{ $icon }} text-warning fs-3"></i>


</div>



<h4 class="fw-bold mb-0">

{{ $facility->name }}

</h4>



</div>






<p class="text-muted">

{{ $facility->description ?? 'Fasilitas terbaik untuk kenyamanan tamu HOTEL ADIMULIA.' }}

</p>





<hr>





<div class="d-flex gap-2">



<a href="{{ route('admin.facilities.edit',$facility) }}"

class="btn btn-outline-warning rounded-pill flex-fill">


<i class="bi bi-pencil-square me-1"></i>

Edit


</a>






<form

action="{{ route('admin.facilities.destroy',$facility) }}"

method="POST"

class="flex-fill">


@csrf

@method('DELETE')



<button

onclick="return confirm('Yakin ingin menghapus fasilitas ini?')"

class="btn btn-outline-danger rounded-pill w-100">


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


<i class="bi bi-stars display-4"></i>


<h5 class="mt-3">

Belum ada fasilitas

</h5>


<p>

Silahkan tambahkan fasilitas baru.

</p>


</div>


</div>



@endforelse





</div>






<div class="mt-5">


{{ $facilities->links() }}


</div>





</div>


@endsection