<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Daftar kamar yang tersedia
     */
    public function index(Request $request)
    {
        $roomType = $request->room_type;

        $roomTypes = RoomType::all();

        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->when($roomType, function ($query) use ($roomType) {
                $query->where('room_type_id', $roomType);
            })
            ->paginate(9);

        return view('customer.booking.index', compact(
            'rooms',
            'roomTypes',
            'roomType'
        ));
    }

    /**
     * Detail kamar
     */
    public function show(Room $room)
    {
        $room->load('roomType');

        return view('customer.booking.show', compact('room'));
    }

    /**
     * Form booking
     */
    public function create(Room $room)
    {
        if ($room->status != 'available') {
            return redirect()
                ->route('customer.booking.index')
                ->with('error', 'Kamar sudah tidak tersedia.');
        }

        $room->load('roomType');

        return view('customer.booking.create', compact('room'));
    }

    /**
     * Simpan booking
     */
    public function store(Request $request, Room $room)
    {
        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guest'     => 'required|integer|min:1',
        ]);

        $days = Carbon::parse($request->check_in)
            ->diffInDays(Carbon::parse($request->check_out));

        if ($days <= 0) {
            $days = 1;
        }

        $total = $days * $room->roomType->price_per_night;

        Booking::create([
            'user_id'     => auth()->id(),
            'room_id'     => $room->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guest'       => $request->guest,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        $room->update([
            'status' => 'occupied',
        ]);

        return redirect()
            ->route('customer.history')
            ->with('success', 'Booking berhasil dibuat.');
    }

    /**
     * Riwayat booking customer
     */
    public function history()
    {
        $bookings = Booking::with([
            'room.roomType',
            'payment'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

        return view('customer.booking.history', compact('bookings'));
    }
}