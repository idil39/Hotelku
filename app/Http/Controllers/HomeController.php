<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()
            ->take(3)
            ->get();

        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->get();

        $facilities = Facility::latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'roomTypes',
            'rooms',
            'facilities'
        ));
    }
}