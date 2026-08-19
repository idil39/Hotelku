@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">Edit Room Type</h2>
        <small class="text-muted">Perbarui data tipe kamar</small>
    </div>

    <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

<div class="card shadow border-0 rounded-4">

    <div class="card-body p-4">

        <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Room Type
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $roomType->name) }}"
                    class="form-control @error('name') is-invalid @enderror">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control">{{ old('description', $roomType->description) }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Harga per Malam
                </label>

                <input
                    type="number"
                    name="price_per_night"
                    value="{{ old('price_per_night', $roomType->price_per_night) }}"
                    class="form-control @error('price_per_night') is-invalid @enderror">

                @error('price_per_night')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Kapasitas
                </label>

                <input
                    type="number"
                    name="capacity"
                    value="{{ old('capacity', $roomType->capacity) }}"
                    class="form-control @error('capacity') is-invalid @enderror">

                @error('capacity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button class="btn btn-warning text-white">
                <i class="bi bi-pencil-square"></i>
                Update
            </button>

            <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>

    </div>

</div>

@endsection