<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return view('customer.dashboard', [
            'totalBooking' => Booking::where('user_id', $user->id)->count(),

            'activeBooking' => Booking::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'confirmed', 'check_in'])
                ->count(),

            'completedBooking' => Booking::where('user_id', $user->id)
                ->where('status', 'check_out')
                ->count(),

            'availableRooms' => Room::where('status', 'available')->count(),

            'latestBookings' => Booking::with('room.roomType')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}