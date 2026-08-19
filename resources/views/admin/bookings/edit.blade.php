@extends('layouts.admin')

@section('title','Edit Booking')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4>Edit Booking</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.bookings.update',$booking) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        Customer
                    </label>

                    <select name="user_id" class="form-select">

                        @foreach($customers as $customer)

                            <option value="{{ $customer->id }}"
                                {{ $booking->user_id == $customer->id ? 'selected' : '' }}>

                                {{ $customer->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kamar
                    </label>

                    <select name="room_id" class="form-select">

                        @foreach($rooms as $room)

                            <option value="{{ $room->id }}"
                                {{ $booking->room_id == $room->id ? 'selected' : '' }}>

                                {{ $room->room_number }}
                                -
                                {{ $room->roomType->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Check In
                        </label>

                        <input
                            type="date"
                            name="check_in"
                            class="form-control"
                            value="{{ old('check_in', optional($booking->check_in)->format('Y-m-d')) }}"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Check Out
                        </label>

                        <input
                            type="date"
                            name="check_out"
                            class="form-control"
                            value="{{ old('check_out', optional($booking->check_out)->format('Y-m-d')) }}"
                            required>

                    </div>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Jumlah Tamu
                    </label>

                    <input
                        type="number"
                        name="guest"
                        class="form-control"
                        value="{{ old('guest', $booking->guest) }}"
                        required>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Status Booking
                    </label>

                    <select name="status" class="form-select">

                        <option value="pending"
                            {{ $booking->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="confirmed"
                            {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>

                        <option value="check_in"
                            {{ $booking->status == 'check_in' ? 'selected' : '' }}>
                            Check In
                        </option>

                        <option value="check_out"
                            {{ $booking->status == 'check_out' ? 'selected' : '' }}>
                            Check Out
                        </option>

                        <option value="cancelled"
                            {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                </div>

                <div class="mt-4">

                    <button type="submit" class="btn btn-primary">
                        Update Booking
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