@extends('layouts.customer')

@section('title','Detail Pembayaran')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        Detail Pembayaran

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <p>

                                <strong>Jenis Kamar :</strong>

                                {{ $payment->booking->room->roomType->name }}

                            </p>

                            <p>

                                <strong>Nomor Kamar :</strong>

                                {{ $payment->booking->room->room_number }}

                            </p>

                            <p>

                                <strong>Metode :</strong>

                                {{ $payment->payment_method }}

                            </p>

                            <p>

                                <strong>Total :</strong>

                                Rp {{ number_format($payment->amount,0,',','.') }}

                            </p>

                        </div>

                        <div class="col-md-6">

                            <p>

                                <strong>Status :</strong>

                            </p>

                            @if($payment->status=='pending')

                                <span class="badge bg-warning fs-6">

                                    Pending

                                </span>

                            @elseif($payment->status=='paid')

                                <span class="badge bg-success fs-6">

                                    Paid

                                </span>

                            @else

                                <span class="badge bg-danger fs-6">

                                    Failed

                                </span>

                            @endif

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">

                        Bukti Pembayaran

                    </h5>

                    <img src="{{ asset('storage/'.$payment->proof) }}"
                         class="img-fluid rounded shadow">

                    <div class="mt-4">

                        <a href="{{ route('customer.payment.index') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection