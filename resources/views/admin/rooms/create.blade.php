@extends('layouts.admin')

@section('title','Tambah Kamar')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Tambah Kamar

            </h2>

            <p class="text-muted mb-0">

                Tambahkan kamar baru HOTEL ADIMULIA

            </p>

        </div>

        <a href="{{ route('admin.rooms.index') }}"
           class="btn btn-secondary rounded-pill">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card border-0 shadow rounded-4">

        <div class="card-body">

            <form action="{{ route('admin.rooms.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Tipe Kamar

                    </label>

                    <select
                        name="room_type_id"
                        class="form-select @error('room_type_id') is-invalid @enderror">

                        <option value="">

                            -- Pilih Tipe Kamar --

                        </option>

                        @foreach($roomTypes as $type)

                            <option
                                value="{{ $type->id }}"
                                {{ old('room_type_id')==$type->id ? 'selected' : '' }}>

                                {{ $type->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('room_type_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Nomor Kamar

                    </label>

                    <input
                        type="text"
                        name="room_number"
                        value="{{ old('room_number') }}"
                        class="form-control @error('room_number') is-invalid @enderror">

                    @error('room_number')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror">

                        <option value="available">

                            Available

                        </option>

                        <option value="booked">

                            Booked

                        </option>

                        <option value="maintenance">

                            Maintenance

                        </option>

                    </select>

                    @error('status')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Foto Kamar

                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror">

                    @error('image')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <button
                    type="submit"
                    class="btn btn-primary rounded-pill">

                    <i class="bi bi-save"></i>

                    Simpan

                </button>

                <a href="{{ route('admin.rooms.index') }}"
                   class="btn btn-secondary rounded-pill">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>

@endsection