@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')

<section class="py-5 bg-light" style="min-height:100vh;">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('images/logo/logo.png') }}"
                                alt="HOTEL ADIMULIA"
                                class="img-fluid mb-3"
                                style="max-width:100px;">

                            <h2 class="fw-bold text-primary">

                                HOTEL ADIMULIA

                            </h2>

                            <p class="text-muted">

                                Silakan buat password baru untuk akun Anda.

                            </p>

                        </div>

                        <form method="POST" action="{{ route('password.store') }}">

                            @csrf

                            <input
                                type="hidden"
                                name="token"
                                value="{{ request()->route('token') }}">

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', request()->email) }}"
                                    class="form-control @error('email') is-invalid @enderror"
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

                                    Password Baru

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

                                <i class="bi bi-key-fill"></i>

                                Simpan Password Baru

                            </button>

                        </form>

                        <div class="text-center mt-4">

                            <a
                                href="{{ route('login') }}"
                                class="text-decoration-none">

                                ← Kembali ke Login

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection