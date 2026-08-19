@extends('layouts.admin')

@section('title','Kelola Pembayaran')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Kelola Pembayaran
            </h2>

            <p class="text-muted mb-0">
                Verifikasi pembayaran customer HOTEL ADIMULIA
            </p>

        </div>

        <div>

            <span class="badge bg-primary px-4 py-3 rounded-pill">

                <i class="bi bi-credit-card me-2"></i>

                Payment Management

            </span>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif



    {{-- CARD TABLE --}}

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">


        <div class="card-header bg-gradient text-white py-3"
             style="background:#0d6efd">


            <h5 class="mb-0">

                <i class="bi bi-wallet2 me-2"></i>

                Daftar Pembayaran

            </h5>


        </div>



        <div class="card-body p-4">


            <div class="table-responsive">


                <table class="table align-middle table-hover">


                    <thead class="table-light">


                        <tr>

                            <th>No</th>

                            <th>Customer</th>

                            <th>Kamar</th>

                            <th>Total</th>

                            <th>Metode</th>

                            <th>Bukti</th>

                            <th>Status</th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>


                    </thead>



                    <tbody>


                    @forelse($payments as $payment)


                        <tr>


                            <td>

                                {{ $loop->iteration }}

                            </td>



                            <td>


                                <div class="d-flex align-items-center">


                                    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
                                         style="width:40px;height:40px">


                                        <i class="bi bi-person"></i>


                                    </div>


                                    <strong>

                                        {{ $payment->booking->user->name ?? '-' }}

                                    </strong>


                                </div>


                            </td>



                            <td>


                                <strong>

                                    {{ $payment->booking->room->room_number ?? '-' }}

                                </strong>


                                <br>


                                <small class="text-muted">

                                    {{ $payment->booking->room->roomType->name ?? '-' }}

                                </small>


                            </td>




                            <td>


                                <span class="fw-bold text-success">


                                    Rp {{ number_format($payment->amount,0,',','.') }}


                                </span>


                            </td>




                            <td>


                                <span class="badge bg-light text-dark border">


                                    <i class="bi bi-bank me-1"></i>


                                    {{ $payment->payment_method }}


                                </span>


                            </td>




                            <td>


                                @if($payment->proof)


                                    <a href="{{ asset('storage/'.$payment->proof) }}"
                                       target="_blank">


                                        <img
                                            src="{{ asset('storage/'.$payment->proof) }}"
                                            width="80"
                                            height="60"
                                            class="rounded shadow-sm"
                                            style="object-fit:cover">


                                    </a>


                                @else


                                    <span class="badge bg-secondary">

                                        Tidak ada

                                    </span>


                                @endif


                            </td>




                            <td>


                                @if($payment->status=='paid')


                                    <span class="badge bg-success px-3 py-2">

                                        <i class="bi bi-check-circle"></i>

                                        Paid

                                    </span>


                                @elseif($payment->status=='failed')


                                    <span class="badge bg-danger px-3 py-2">

                                        Failed

                                    </span>


                                @else


                                    <span class="badge bg-warning text-dark px-3 py-2">

                                        Pending

                                    </span>


                                @endif


                            </td>




                            <td>


                                @if($payment->status=='pending')


                                <div class="d-flex gap-2">


                                    <form action="{{ route('admin.payments.approve',$payment) }}"
                                          method="POST">


                                        @csrf

                                        @method('PUT')


                                        <button
                                            class="btn btn-success btn-sm rounded-pill"
                                            onclick="return confirm('Approve pembayaran ini?')">


                                            <i class="bi bi-check-lg"></i>

                                        </button>


                                    </form>




                                    <form action="{{ route('admin.payments.reject',$payment) }}"
                                          method="POST">


                                        @csrf

                                        @method('PUT')


                                        <button
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="return confirm('Tolak pembayaran ini?')">


                                            <i class="bi bi-x-lg"></i>


                                        </button>


                                    </form>


                                </div>


                                @else


                                    <span class="text-muted">

                                        Selesai

                                    </span>


                                @endif



                            </td>



                        </tr>


                    @empty


                        <tr>

                            <td colspan="8"
                                class="text-center py-5">


                                <i class="bi bi-credit-card-2-front display-4 text-secondary"></i>


                                <h5 class="mt-3">

                                    Belum ada pembayaran

                                </h5>


                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>


            </div>



            <div class="mt-4">

                {{ $payments->links() }}

            </div>


        </div>


    </div>


</div>


@endsection