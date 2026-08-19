<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar kamar
     */
    public function index()
    {
        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->paginate(9);

        return view('customer.booking.index', compact('rooms'));
    }

    /**
     * Menampilkan detail kamar
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
    'guest'     => 'required|integer|min:1|max:'.$room->roomType->capacity,
]);

        $days = max(
            1,
            Carbon::parse($request->check_in)
                ->diffInDays(Carbon::parse($request->check_out))
        );

        $total = $days * $room->roomType->price_per_night;

        Booking::create([
            'user_id'     => Auth::id(),
            'room_id'     => $room->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guest'       => $request->guest,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        $room->update([
            'status' => 'booked',
        ]);

        return redirect()
    ->route('customer.history')
    ->with('success', 'Booking berhasil dibuat. Silakan lakukan pembayaran.');
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
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.booking.history', compact('bookings'));
    }
}