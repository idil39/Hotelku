@extends('layouts.admin')

@section('title','Edit Fasilitas')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow rounded-4">

                <div class="card-header bg-warning">

                    <h4 class="mb-0">

                        Edit Fasilitas

                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('admin.facilities.update',$facility) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Fasilitas

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name',$facility->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description',$facility->description) }}</textarea>

                            @error('description')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Foto Fasilitas

                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                                onchange="previewImage(event)">

                            @error('image')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="text-center mb-4">

                            @if($facility->image)

                                <img
                                    id="preview"
                                    src="{{ asset('storage/'.$facility->image) }}"
                                    class="img-thumbnail rounded"
                                    style="max-width:300px;">

                            @else

                                <img
                                    id="preview"
                                    src="https://placehold.co/300x200?text=Preview"
                                    class="img-thumbnail rounded"
                                    style="max-width:300px;">

                            @endif

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('admin.facilities.index') }}"
                               class="btn btn-secondary rounded-pill">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                            <button
                                type="submit"
                                class="btn btn-warning rounded-pill">

                                <i class="bi bi-save"></i>

                                Update

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