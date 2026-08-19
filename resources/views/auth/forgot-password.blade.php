@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')

<section class="py-5 bg-light" style="min-height:100vh;">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-5">

<div class="card shadow border-0 rounded-4">

<div class="card-body p-5">

<div class="text-center mb-4">

<img src="{{ asset('images/logo/logo.png') }}"
width="100"
class="mb-3">

<h2 class="fw-bold text-primary">

HOTEL ADIMULIA

</h2>

<p class="text-muted">

Masukkan email Anda untuk menerima link reset password.

</p>

</div>

@if (session('status'))

<div class="alert alert-success">

{{ session('status') }}

</div>

@endif

<form method="POST"
action="{{ route('password.email') }}">

@csrf

<div class="mb-4">

<label>Email</label>

<input
type="email"
name="email"
class="form-control @error('email') is-invalid @enderror"
value="{{ old('email') }}"
required>

@error('email')

<div class="invalid-feedback">

{{ $message }}

</div>

@enderror

</div>

<button class="btn btn-primary w-100 rounded-pill">

Kirim Link Reset Password

</button>

</form>

<div class="text-center mt-4">

<a href="{{ route('login') }}">

← Kembali Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

@endsection