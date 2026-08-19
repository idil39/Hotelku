@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<section class="py-5 bg-light" style="min-height:100vh;">

    <div class="container">

        <div class="row justify-content-center align-items-center">

            <div class="col-lg-5 col-md-7">

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

                                Silakan login untuk melanjutkan ke sistem.

                            </p>

                        </div>

                        @if(session('status'))

                            <div class="alert alert-success">

                                {{ session('status') }}

                            </div>

                        @endif

                        <form method="POST" action="{{ route('login') }}">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email"
                                    required
                                    autofocus>

                                @error('email')

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
                                    placeholder="Masukkan password"
                                    required>

                                @error('password')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="remember"
                                        id="remember">

                                    <label
                                        class="form-check-label"
                                        for="remember">

                                        Ingat Saya

                                    </label>

                                </div>

                                @if (Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        class="text-decoration-none">

                                        Lupa Password?

                                    </a>

                                @endif

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 rounded-pill py-2">

                                <i class="bi bi-box-arrow-in-right"></i>

                                Login

                            </button>

                        </form>

                        <hr class="my-4">

                        <div class="text-center">

                            Belum memiliki akun?

                            <a
                                href="{{ route('register') }}"
                                class="fw-bold text-decoration-none">

                                Daftar Sekarang

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