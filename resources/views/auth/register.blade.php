@extends('layouts.guest')

@section('title', 'Register')

@section('content')

<section class="py-5 bg-light" style="min-height:100vh;">

    <div class="container">

        <div class="row justify-content-center align-items-center">

            <div class="col-lg-6 col-md-8">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('images/logo/logo.png') }}"
                                alt="HOTEL ADIMULIA"
                                class="img-fluid mb-3"
                                style="max-width:120px;">

                            <h2 class="fw-bold text-primary">

                                HOTEL ADIMULIA

                            </h2>

                            <p class="text-muted">

                                Buat akun baru untuk melakukan pemesanan hotel.

                            </p>

                        </div>

                        <form method="POST" action="{{ route('register') }}">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Nama Lengkap

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required>

                                @error('name')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required>

                                @error('email')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Nomor HP

                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Alamat

                                </label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                                @error('address')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required>

                                @error('password')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label">

                                    Konfirmasi Password

                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    required>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 rounded-pill py-2">

                                <i class="bi bi-person-plus-fill"></i>

                                Daftar Sekarang

                            </button>

                        </form>

                        <hr class="my-4">

                        <div class="text-center">

                            Sudah memiliki akun?

                            <a
                                href="{{ route('login') }}"
                                class="fw-bold text-decoration-none">

                                Login

                            </a>

                        </div>

                        <div class="text-center mt-3">

                            <a
                                href="{{ url('/') }}"
                                class="text-decoration-none">

                                ← Kembali ke Beranda

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection