<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
HOTEL ADIMULIA ADMIN
</title>


@vite([
'resources/css/app.css',
'resources/js/app.js'
])


<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">



<style>


body{

    background:#f8f7f3;

    font-family:'Poppins',sans-serif;

}



/* ================= SIDEBAR ================= */


.sidebar{


    position:fixed;

    top:0;

    left:0;


    width:260px;


    height:100vh;


    background:

    linear-gradient(
        180deg,
        #111827,
        #1f2937
    );


    padding:20px;


    color:white;


    box-shadow:

    5px 0 25px rgba(0,0,0,.15);


}



.logo{


    padding-bottom:25px;


    margin-bottom:20px;


    border-bottom:

    1px solid rgba(255,255,255,.15);


}




.logo img{


    border-radius:50%;


}



.logo h6{


    letter-spacing:1px;


}



/* MENU */


.sidebar a{


    display:flex;


    align-items:center;


    gap:14px;


    padding:13px 15px;


    margin-bottom:8px;


    border-radius:12px;


    text-decoration:none;


    color:#d1d5db;


    transition:.3s;


}



.sidebar a i{


    font-size:19px;


}




.sidebar a:hover,


.sidebar a.active{


    background:

    linear-gradient(
        135deg,
        #d4af37,
        #f5d76e
    );


    color:#111827;


}






/* ================= TOPBAR ================= */



.topbar{


    margin-left:260px;


    height:85px;


    background:white;


    display:flex;


    justify-content:space-between;


    align-items:center;


    padding:15px 35px;


    box-shadow:

    0 5px 20px rgba(0,0,0,.08);


}






.search-box input{


    width:260px;


    border-radius:30px;


    padding:10px 20px;


}






/* ================= CONTENT ================= */


.main-content{


    margin-left:260px;


    padding:35px;


}






.card{


    border:none!important;


    border-radius:20px!important;


    box-shadow:

    0 10px 30px rgba(0,0,0,.08);


}




.btn-gold{


    background:

    linear-gradient(
        135deg,
        #d4af37,
        #f5d76e
    );


    border:none;


    color:#111;


    font-weight:600;


}




</style>


</head>


<body>

<body>


{{-- ================= SIDEBAR ================= --}}

<div class="sidebar">


    <div class="logo d-flex align-items-center">


        <img
        src="{{ asset('images/logo/logo.png') }}"
        width="45"
        height="45"
        class="me-3">


        <div>

            <h6 class="mb-0 fw-bold">
                HOTEL ADIMULIA
            </h6>

            <small class="text-secondary">
                Admin Panel
            </small>

        </div>


    </div>





    <a href="{{ route('admin.dashboard') }}"
    class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">

        <i class="bi bi-grid"></i>

        Dashboard

    </a>




    <a href="{{ route('admin.room-types.index') }}"
    class="{{ request()->routeIs('admin.room-types.*')?'active':'' }}">

        <i class="bi bi-building"></i>

        Room Type

    </a>




    <a href="{{ route('admin.rooms.index') }}"
    class="{{ request()->routeIs('admin.rooms.*')?'active':'' }}">

        <i class="bi bi-door-open"></i>

        Rooms

    </a>




    <a href="{{ route('admin.facilities.index') }}"
    class="{{ request()->routeIs('admin.facilities.*')?'active':'' }}">

        <i class="bi bi-stars"></i>

        Facilities

    </a>




    <a href="{{ route('admin.bookings.index') }}"
    class="{{ request()->routeIs('admin.bookings.*')?'active':'' }}">

        <i class="bi bi-calendar-check"></i>

        Booking

    </a>




    <a href="{{ route('admin.payments.index') }}"
    class="{{ request()->routeIs('admin.payments.*')?'active':'' }}">

        <i class="bi bi-credit-card"></i>

        Payment

    </a>




    <a href="{{ route('admin.users.index') }}"
    class="{{ request()->routeIs('admin.users.*')?'active':'' }}">

        <i class="bi bi-people"></i>

        Users

    </a>




    <a href="#">

        <i class="bi bi-bar-chart"></i>

        Reports

    </a>




    <a href="#">

        <i class="bi bi-gear"></i>

        Settings

    </a>



</div>







{{-- ================= TOPBAR ================= --}}


<div class="topbar">


    <div>

        <h3 class="fw-bold mb-0">

            @yield('title','Dashboard')

        </h3>


        <small class="text-muted">

            Welcome Back Administrator 👋

        </small>


    </div>





    <div class="d-flex align-items-center gap-4">



        <i class="bi bi-bell fs-4"></i>


        <i class="bi bi-envelope fs-4"></i>




        <div class="d-flex align-items-center">


            <img
            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=d4af37&color=111"
            width="45"
            height="45"
            class="rounded-circle">



            <div class="ms-3">


                <strong>

                    {{ auth()->user()->name }}

                </strong>


                <br>


                <small class="text-muted">

                    Administrator

                </small>



            </div>


        </div>





        {{-- LOGOUT SEPERTI CUSTOMER --}}


        <form action="{{ route('logout') }}"
        method="POST">


            @csrf


            <button
            class="btn btn-danger rounded-pill px-4">


                <i class="bi bi-box-arrow-right me-2"></i>


                Logout


            </button>


        </form>




    </div>



</div>







{{-- ================= CONTENT ================= --}}



<main class="main-content">


<div class="container-fluid">



@if(session('success'))

<div class="alert alert-success rounded-4">

{{ session('success') }}

</div>

@endif




@if(session('error'))

<div class="alert alert-danger rounded-4">

{{ session('error') }}

</div>

@endif





@yield('content')




</div>


</main>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>