@extends('layouts.customer')

@section('title','Upload Pembayaran')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        Upload Bukti Pembayaran

                    </h4>

                </div>

                <div class="card-body">

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <h5>

                                Informasi Booking

                            </h5>

                            <hr>

                            <p>

                                <strong>Jenis Kamar :</strong>

                                {{ $booking->room->roomType->name }}

                            </p>

                            <p>

                                <strong>Nomor Kamar :</strong>

                                {{ $booking->room->room_number }}

                            </p>

                            <p>

                                <strong>Check In :</strong>

                                {{ $booking->check_in->format('d M Y') }}

                            </p>

                            <p>

                                <strong>Check Out :</strong>

                                {{ $booking->check_out->format('d M Y') }}

                            </p>

                        </div>

                        <div class="col-md-6">

                            <h5>

                                Total Pembayaran

                            </h5>

                            <hr>

                            <h2 class="text-success fw-bold">

                                Rp {{ number_format($booking->total_price,0,',','.') }}

                            </h2>

                            <span class="badge bg-warning">

                                Menunggu Pembayaran

                            </span>

                        </div>

                    </div>

                    <form
                        action="{{ route('customer.payment.store',$booking->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Metode Pembayaran

                            </label>

                            <select
                                name="payment_method"
                                class="form-select"
                                required>

                                <option value="">

                                    -- Pilih Metode --

                                </option>

                                <option value="Transfer BCA">

                                    Transfer BCA

                                </option>

                                <option value="Transfer Mandiri">

                                    Transfer Mandiri

                                </option>

                                <option value="Transfer BNI">

                                    Transfer BNI

                                </option>

                                <option value="Transfer BRI">

                                    Transfer BRI

                                </option>

                                <option value="QRIS">

                                    QRIS

                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Bukti Pembayaran

                            </label>

                            <input
                                type="file"
                                name="proof"
                                class="form-control"
                                accept="image/*"
                                onchange="previewImage(event)"
                                required>

                        </div>

                        <div class="text-center mb-4">

                            <img
                                id="preview"
                                src="https://placehold.co/400x250?text=Preview+Image"
                                class="img-fluid rounded shadow"
                                style="max-height:250px;">

                        </div>

                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('customer.history') }}"
                                class="btn btn-secondary">

                                Kembali

                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                Upload Pembayaran

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function previewImage(event){

    let reader = new FileReader();

    reader.onload = function(){

        document.getElementById('preview').src = reader.result;

    }

    reader.readAsDataURL(event.target.files[0]);

}

</script>

@endsection