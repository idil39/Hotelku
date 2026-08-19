@extends('layouts.guest')

@section('title', 'Verifikasi Email')

@section('content')

<section class="py-5 bg-light" style="min-height:100vh;">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('images/logo/logo.png') }}"
                                width="100"
                                class="mb-3"
                                alt="HOTEL ADIMULIA">

                            <h2 class="fw-bold text-primary">

                                HOTEL ADIMULIA

                            </h2>

                            <p class="text-muted">

                                Verifikasi Email

                            </p>

                        </div>

                        <div class="alert alert-info rounded-4">

                            Terima kasih telah melakukan registrasi.

                            Sebelum menggunakan sistem,

                            silakan cek email Anda dan klik link

                            verifikasi yang telah kami kirimkan.

                        </div>

                        @if (session('status') == 'verification-link-sent')

                            <div class="alert alert-success rounded-4">

                                Link verifikasi baru berhasil dikirim

                                ke alamat email Anda.

                            </div>

                        @endif

                        <div class="d-grid gap-3 mt-4">

                            <form method="POST"
                                  action="{{ route('verification.send') }}">

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-primary rounded-pill w-100">

                                    Kirim Ulang Link Verifikasi

                                </button>

                            </form>

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button
                                    class="btn btn-outline-danger rounded-pill w-100">

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection