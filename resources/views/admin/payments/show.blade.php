@extends('layouts.admin')

@section('title','Detail Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="card shadow border-0">

                <div class="card-header bg-dark text-white">

                    <h4 class="mb-0">

                        Detail Pembayaran

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-6">

                            <h5 class="fw-bold mb-3">

                                Informasi Customer

                            </h5>

                            <table class="table">

                                <tr>

                                    <th width="180">Nama</th>

                                    <td>{{ $payment->booking->user->name }}</td>

                                </tr>

                                <tr>

                                    <th>Email</th>

                                    <td>{{ $payment->booking->user->email }}</td>

                                </tr>

                                <tr>

                                    <th>No. HP</th>

                                    <td>{{ $payment->booking->user->phone ?? '-' }}</td>

                                </tr>

                            </table>

                            <h5 class="fw-bold mt-4 mb-3">

                                Informasi Booking

                            </h5>

                            <table class="table">

                                <tr>

                                    <th width="180">Jenis Kamar</th>

                                    <td>{{ $payment->booking->room->roomType->name }}</td>

                                </tr>

                                <tr>

                                    <th>Nomor Kamar</th>

                                    <td>{{ $payment->booking->room->room_number }}</td>

                                </tr>

                                <tr>

                                    <th>Check In</th>

                                    <td>{{ $payment->booking->check_in->format('d M Y') }}</td>

                                </tr>

                                <tr>

                                    <th>Check Out</th>

                                    <td>{{ $payment->booking->check_out->format('d M Y') }}</td>

                                </tr>

                                <tr>

                                    <th>Total</th>

                                    <td>

                                        <strong>

                                            Rp {{ number_format($payment->amount,0,',','.') }}

                                        </strong>

                                    </td>

                                </tr>

                                <tr>

                                    <th>Metode</th>

                                    <td>{{ $payment->payment_method }}</td>

                                </tr>

                                <tr>

                                    <th>Status</th>

                                    <td>

                                        @if($payment->status=='pending')

                                            <span class="badge bg-warning">

                                                Pending

                                            </span>

                                        @elseif($payment->status=='paid')

                                            <span class="badge bg-success">

                                                Paid

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Failed

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            </table>

                        </div>

                        <div class="col-lg-6">

                            <h5 class="fw-bold mb-3">

                                Bukti Pembayaran

                            </h5>

                            <img src="{{ asset('storage/'.$payment->proof) }}"
                                 class="img-fluid rounded shadow border">

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('admin.payments.index') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                        @if($payment->status=='pending')

                            <div>

                                <form action="{{ route('admin.payments.reject',$payment->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-danger">

                                        Tolak

                                    </button>

                                </form>

                                <form action="{{ route('admin.payments.approve',$payment->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-success">

                                        Approve

                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection