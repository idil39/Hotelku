<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Customer
        $customers = User::where('role', 'customer')->count();

        // Statistik Room Type
        $roomTypes = RoomType::count();

        // Statistik Kamar
        $rooms = Room::count();

        $availableRooms = Room::where('status', 'available')->count();

        $occupiedRooms = Room::where('status', 'booked')->count();

        // Statistik Booking
        $bookings = Booking::count();

        $pendingBookings = Booking::where('status', 'pending')->count();

        // Total Pendapatan
        $income = Payment::where('status', 'paid')
            ->sum('amount');

        // Booking Terbaru
        $latestBookings = Booking::with([
                'user',
                'room.roomType'
            ])
            ->latest()
            ->take(5)
            ->get();

        // Data Grafik
        $chartData = [
            $customers,
            $roomTypes,
            $rooms,
            $bookings,
        ];

        return view('admin.dashboard', [

            'customers'        => $customers,
            'roomTypes'        => $roomTypes,
            'rooms'            => $rooms,
            'availableRooms'   => $availableRooms,
            'occupiedRooms'    => $occupiedRooms,
            'bookings'         => $bookings,
            'pendingBookings'  => $pendingBookings,
            'income'           => $income,
            'latestBookings'   => $latestBookings,
            'chartData'        => $chartData,

        ]);
    }
}