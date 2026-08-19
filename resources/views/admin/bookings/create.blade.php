@extends('layouts.admin')

@section('title','Tambah Booking')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4>Tambah Booking</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.bookings.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">

                        Customer

                    </label>

                    <select name="user_id"
                            class="form-select"
                            required>

                        <option value="">

                            -- Pilih Customer --

                        </option>

                        @foreach($customers as $customer)

                            <option value="{{ $customer->id }}">

                                {{ $customer->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Kamar

                    </label>

                    <select name="room_id"
                            class="form-select"
                            required>

                        <option value="">

                            -- Pilih Kamar --

                        </option>

                        @foreach($rooms as $room)

                            <option value="{{ $room->id }}">

                                {{ $room->room_number }}
                                -
                                {{ $room->roomType->name }}
                                -
                                Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}/Malam

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">

                            Check In

                        </label>

                        <input type="date"
                               name="check_in"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Check Out

                        </label>

                        <input type="date"
                               name="check_out"
                               class="form-control"
                               required>

                    </div>

                </div>

                <div class="mt-3">

                    <label class="form-label">

                        Jumlah Tamu

                    </label>

                    <input type="number"
                           name="guest"
                           class="form-control"
                           min="1"
                           value="1"
                           required>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary">

                        Simpan Booking

                    </button>

                    <a href="{{ route('admin.bookings.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection