@extends('layouts.customer')

@section('title', 'Booking Hotel')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Booking Hotel
            </h2>

            <p class="text-muted mb-0">
                Pilih kamar yang tersedia
            </p>
        </div>

    </div>

    <div class="row">

        @forelse($rooms as $room)

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <h4 class="fw-bold">
                        {{ $room->roomType->name }}
                    </h4>

                    <hr>

                    <p>
                        <strong>Nomor Kamar :</strong><br>
                        {{ $room->room_number }}
                    </p>

                    <p>
                        <strong>Kapasitas :</strong><br>
                        {{ $room->roomType->capacity }} Orang
                    </p>

                    <p>
                        <strong>Harga :</strong><br>

                        <span class="text-success fw-bold fs-5">

                            Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                        </span>

                        / malam

                    </p>

                    <p class="text-muted">

                        {{ $room->roomType->description }}

                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="{{ route('customer.booking.create',$room) }}"
                       class="btn btn-primary w-100">

                        Booking Sekarang

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-warning">

                Belum ada kamar tersedia.

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection