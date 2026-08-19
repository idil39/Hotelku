@extends('layouts.customer')

@section('title', 'Booking Kamar')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white rounded-top-4">

                    <h3 class="mb-0">

                        Booking Kamar

                    </h3>

                </div>

                <div class="card-body p-4">

                    <div class="row">

                        <div class="col-md-6">

                            @php

                                $image = match(strtolower($room->roomType->name)) {

                                    'standard' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',

                                    'deluxe' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',

                                    'suite' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',

                                    default => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80',

                                };

                            @endphp

                            <img src="{{ $image }}"
                                 class="img-fluid rounded-4 shadow mb-3"
                                 style="height:280px; width:100%; object-fit:cover;">

                        </div>

                        <div class="col-md-6">

                            <h3 class="fw-bold">

                                {{ $room->roomType->name }}

                            </h3>

                            <p>

                                <strong>Nomor Kamar :</strong>

                                {{ $room->room_number }}

                            </p>

                            <p>

                                <strong>Kapasitas :</strong>

                                {{ $room->roomType->capacity }} Orang

                            </p>

                            <p>

                                <strong>Harga :</strong>

                                Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                                / malam

                            </p>

                            <p>

                                {{ $room->roomType->description }}

                            </p>

                        </div>

                    </div>

                    <hr>

                    <form action="{{ route('customer.booking.store', $room->id) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Check In

                            </label>

                            <input type="date"
                                   name="check_in"
                                   class="form-control"
                                   value="{{ old('check_in') }}"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Check Out

                            </label>

                            <input type="date"
                                   name="check_out"
                                   class="form-control"
                                   value="{{ old('check_out') }}"
                                   required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Jumlah Tamu

                            </label>

                            <input type="number"
                                   name="guest"
                                   class="form-control"
                                   value="1"
                                   min="1"
                                   max="{{ $room->roomType->capacity }}"
                                   required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('customer.booking.index') }}"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-success">

                                <i class="bi bi-calendar-check"></i>

                                Booking Sekarang

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection