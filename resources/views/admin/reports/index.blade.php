@extends('layouts.admin')

@section('title','Laporan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">

            Laporan HOTEL ADIMULIA

        </h2>

        <a href="{{ route('admin.reports.pdf') }}"
           class="btn btn-danger">

            <i class="bi bi-file-earmark-pdf"></i>

            Export PDF

        </a>

    </div>

    <div class="row mb-4">

        <div class="col-lg-3">

            <div class="card shadow border-0 bg-primary text-white">

                <div class="card-body">

                    <h6>Total Booking</h6>

                    <h2>{{ $totalBookings }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow border-0 bg-success text-white">

                <div class="card-body">

                    <h6>Total Customer</h6>

                    <h2>{{ $totalCustomers }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow border-0 bg-warning">

                <div class="card-body">

                    <h6>Total Room</h6>

                    <h2>{{ $totalRooms }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow border-0 bg-dark text-white">

                <div class="card-body">

                    <h6>Total Pendapatan</h6>

                    <h4>

                        Rp {{ number_format($totalIncome,0,',','.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                Data Pembayaran Lunas

            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-striped align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>No</th>

                        <th>Customer</th>

                        <th>Kamar</th>

                        <th>Check In</th>

                        <th>Check Out</th>

                        <th>Metode</th>

                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $payment->booking->user->name }}

                        </td>

                        <td>

                            {{ $payment->booking->room->roomType->name }}

                            <br>

                            <small>

                                Room {{ $payment->booking->room->room_number }}

                            </small>

                        </td>

                        <td>

                            {{ $payment->booking->check_in->format('d M Y') }}

                        </td>

                        <td>

                            {{ $payment->booking->check_out->format('d M Y') }}

                        </td>

                        <td>

                            {{ $payment->payment_method }}

                        </td>

                        <td>

                            Rp {{ number_format($payment->amount,0,',','.') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            Belum ada pembayaran yang disetujui.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">

        {{ $payments->links() }}

    </div>

</div>

@endsection