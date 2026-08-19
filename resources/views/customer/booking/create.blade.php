@extends('layouts.guest')

@section('title','Booking Kamar')

@section('content')

<section class="py-5 mt-5">

    <div class="container">

        <div class="row g-5">

            {{-- ================= INFORMASI KAMAR ================= --}}

            <div class="col-lg-6">

                @php
                    $image = match(strtolower($room->roomType->name)) {
                        'standard' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                        'deluxe'   => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=1200&q=80',
                        'suite'    => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',
                        default    => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80',
                    };
                @endphp

                <img src="{{ $image }}"
                     class="img-fluid rounded-4 shadow mb-4">

                <h2 class="fw-bold">

                    {{ $room->roomType->name }}

                </h2>

                <h4 class="text-warning">

                    Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                    / malam

                </h4>

                <hr>

                <p>

                    {{ $room->roomType->description }}

                </p>

                <ul class="list-group">

                    <li class="list-group-item">

                        Nomor Kamar :
                        <strong>{{ $room->room_number }}</strong>

                    </li>

                    <li class="list-group-item">

                        Kapasitas :
                        <strong>{{ $room->roomType->capacity }} Orang</strong>

                    </li>

                    <li class="list-group-item">

                        Status :
                        <strong class="text-success">

                            {{ ucfirst($room->status) }}

                        </strong>

                    </li>

                </ul>

            </div>

            {{-- ================= FORM BOOKING ================= --}}

            <div class="col-lg-6">

                <div class="card shadow border-0 rounded-4">

                    <div class="card-body p-4">
@if ($errors->any())

<div class="alert alert-danger">

    <strong>Terjadi Kesalahan!</strong>

    <ul class="mb-0 mt-2">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif
                        <h3 class="mb-4">

                            Form Booking

                        </h3>

                        <form action="{{ route('customer.booking.store',$room->id) }}"
                              method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Check In

                                </label>

                                <input
                                    type="date"
                                    class="form-control"
                                    id="check_in"
                                    name="check_in"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Check Out

                                </label>

                                <input
                                    type="date"
                                    class="form-control"
                                    id="check_out"
                                    name="check_out"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Jumlah Tamu

                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="guest"
                                    value="1"
                                    min="1"
                                    max="{{ $room->roomType->capacity }}">

                            </div>

                            <div class="alert alert-warning">

                                <h5>

                                    Ringkasan Booking

                                </h5>

                                <hr>

                                <p>

                                    Harga / Malam :

                                    <strong>

                                        Rp {{ number_format($room->roomType->price_per_night,0,',','.') }}

                                    </strong>

                                </p>

                                <p>

                                    Total Hari :

                                    <span id="days">

                                        0

                                    </span>

                                </p>

                                <h4>

                                    Total :

                                    <span id="total">

                                        Rp 0

                                    </span>

                                </h4>

                            </div>

                            <button
                                class="btn btn-warning w-100 btn-lg rounded-pill">

                                Booking Sekarang

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

const price={{ $room->roomType->price_per_night }};

const checkin=document.getElementById('check_in');

const checkout=document.getElementById('check_out');

function calculate(){

    if(checkin.value && checkout.value){

        const start=new Date(checkin.value);

        const end=new Date(checkout.value);

        const diff=(end-start)/(1000*60*60*24);

        if(diff>0){

            document.getElementById('days').innerHTML=diff;

            document.getElementById('total').innerHTML='Rp '+(diff*price).toLocaleString('id-ID');

        }

    }

}

checkin.addEventListener('change',calculate);

checkout.addEventListener('change',calculate);

</script>

@endsection