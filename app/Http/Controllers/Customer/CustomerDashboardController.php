<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RoomType;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('customer.dashboard', [

            'totalBooking' => Booking::where('user_id',$user->id)->count(),

            'bookingAktif' => Booking::where('user_id',$user->id)
                ->whereIn('status',['pending','confirmed','check_in'])
                ->count(),

            'history' => Booking::where('user_id',$user->id)
                ->where('status','check_out')
                ->count(),

            'rooms' => RoomType::latest()
                ->take(6)
                ->get()

        ]);
    }
}