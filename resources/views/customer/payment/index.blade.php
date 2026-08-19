@extends('layouts.customer')

@section('title','Pembayaran Saya')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="mb-5">

        <h2 class="fw-bold">

            Pembayaran Saya

        </h2>

        <p class="text-muted">

            Pantau status pembayaran booking HOTEL ADIMULIA Anda.

        </p>

    </div>


    @if(session('success'))

        <div class="alert alert-success shadow-sm border-0 rounded-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger shadow-sm border-0 rounded-4">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

        </div>

    @endif



    @if($payments->count())


        <div class="row g-4">


        @foreach($payments as $payment)


            <div class="col-lg-6">


                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">


                    {{-- Header Card --}}

                    <div class="p-4 bg-dark text-white">


                        <div class="d-flex justify-content-between align-items-center">


                            <div>

                                <small class="opacity-75">

                                    Booking Hotel

                                </small>


                                <h4 class="fw-bold mb-0">

                                    {{ $payment->booking->room->roomType->name }}

                                </h4>


                            </div>



                            @if($payment->status=='pending')

                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                                    Pending

                                </span>


                            @elseif($payment->status=='paid')


                                <span class="badge bg-success px-3 py-2 rounded-pill">

                                    Lunas

                                </span>


                            @else


                                <span class="badge bg-danger px-3 py-2 rounded-pill">

                                    Gagal

                                </span>


                            @endif


                        </div>


                    </div>



                    {{-- Body --}}

                    <div class="card-body p-4">


                        <div class="row mb-3">


                            <div class="col-6">


                                <small class="text-muted">

                                    Nomor Kamar

                                </small>


                                <h6 class="fw-bold">

                                    {{ $payment->booking->room->room_number }}

                                </h6>


                            </div>


                            <div class="col-6">


                                <small class="text-muted">

                                    Metode

                                </small>


                                <h6 class="fw-bold">

                                    {{ $payment->payment_method }}

                                </h6>


                            </div>


                        </div>



                        <hr>



                        <div class="mb-3">


                            <small class="text-muted">

                                Total Pembayaran

                            </small>


                            <h3 class="fw-bold text-warning">


                                Rp {{ number_format($payment->amount,0,',','.') }}


                            </h3>


                        </div>




                        <div class="row">


                            <div class="col-6">


                                <small class="text-muted">

                                    Check In

                                </small>


                                <p class="fw-semibold">


                                    {{ $payment->booking->check_in->format('d M Y') }}


                                </p>


                            </div>



                            <div class="col-6">


                                <small class="text-muted">

                                    Check Out

                                </small>


                                <p class="fw-semibold">


                                    {{ $payment->booking->check_out->format('d M Y') }}


                                </p>


                            </div>


                        </div>



                        <div class="d-flex gap-2 mt-4">


                            <a href="{{ route('customer.payment.show',$payment->id) }}"

                               class="btn btn-primary rounded-pill px-4">


                                <i class="bi bi-eye"></i>

                                Detail


                            </a>



                            @if($payment->proof)


                            <a href="{{ asset('storage/'.$payment->proof) }}"

                               target="_blank"

                               class="btn btn-outline-success rounded-pill px-4">


                                <i class="bi bi-image"></i>

                                Bukti


                            </a>


                            @endif


                        </div>


                    </div>


                </div>


            </div>


        @endforeach


        </div>



        <div class="mt-5">


            {{ $payments->links() }}


        </div>



    @else


        <div class="card border-0 shadow rounded-4">


            <div class="card-body text-center py-5">


                <i class="bi bi-credit-card display-3 text-muted"></i>


                <h4 class="mt-3 fw-bold">

                    Belum Ada Pembayaran

                </h4>


                <p class="text-muted">

                    Anda belum melakukan pembayaran booking.

                </p>


            </div>


        </div>


    @endif


</div>

@endsection