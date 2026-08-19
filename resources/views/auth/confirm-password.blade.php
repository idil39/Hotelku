@extends('layouts.guest')

@section('title', 'Konfirmasi Password')

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

                                Demi keamanan akun Anda, silakan masukkan password
                                untuk melanjutkan.

                            </p>

                        </div>

                        <form method="POST"
                              action="{{ route('password.confirm') }}">

                            @csrf

                            <div class="mb-4">

                                <label class="form-label">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                    autofocus>

                                @error('password')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 rounded-pill py-2">

                                <i class="bi bi-shield-lock-fill"></i>

                                Konfirmasi Password

                            </button>

                        </form>

                        <div class="text-center mt-4">

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