<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Laporan HOTEL ADIMULIA</title>

    <style>

        body{

            font-family: DejaVu Sans;

            font-size:12px;

            color:#333;

        }

        h1{

            margin:0;

            text-align:center;

            color:#0d6efd;

        }

        h3{

            text-align:center;

            margin-top:5px;

        }

        table{

            width:100%;

            border-collapse:collapse;

            margin-top:20px;

        }

        table th{

            background:#0d6efd;

            color:white;

            padding:8px;

            border:1px solid #000;

        }

        table td{

            border:1px solid #000;

            padding:7px;

        }

        .summary{

            margin-top:20px;

        }

        .summary table{

            width:50%;

        }

        .summary td{

            border:none;

            padding:4px;

        }

        .footer{

            margin-top:40px;

            text-align:right;

        }

    </style>

</head>

<body>

    <h1>HOTEL ADIMULIA</h1>

    <h3>Laporan Pembayaran Hotel</h3>

    <hr>

    <div class="summary">

        <table>

            <tr>

                <td>Total Booking</td>

                <td>: {{ $totalBookings }}</td>

            </tr>

            <tr>

                <td>Total Customer</td>

                <td>: {{ $totalCustomers }}</td>

            </tr>

            <tr>

                <td>Total Room</td>

                <td>: {{ $totalRooms }}</td>

            </tr>

            <tr>

                <td>Total Pendapatan</td>

                <td>

                    : Rp {{ number_format($totalIncome,0,',','.') }}

                </td>

            </tr>

        </table>

    </div>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Customer</th>

                <th>Kamar</th>

                <th>Check In</th>

                <th>Check Out</th>

                <th>Metode</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($payments as $payment)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $payment->booking->user->name }}</td>

                <td>

                    {{ $payment->booking->room->roomType->name }}

                    <br>

                    Room {{ $payment->booking->room->room_number }}

                </td>

                <td>

                    {{ $payment->booking->check_in->format('d/m/Y') }}

                </td>

                <td>

                    {{ $payment->booking->check_out->format('d/m/Y') }}

                </td>

                <td>

                    {{ $payment->payment_method }}

                </td>

                <td>

                    Rp {{ number_format($payment->amount,0,',','.') }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        Dicetak pada :

        {{ now()->format('d F Y H:i') }}

        <br><br><br>

        ______________________

        <br>

        Admin HOTEL ADIMULIA

    </div>

</body>

</html>