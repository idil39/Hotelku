<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'user',
            'room.roomType'
        ])->latest()->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::with('roomType')
            ->where('status', 'available')
            ->get();

        $customers = User::where('role', 'customer')
            ->orderBy('name')
            ->get();

        return view('admin.bookings.create', compact(
            'rooms',
            'customers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guest'     => 'required|integer|min:1',
        ]);

        $room = Room::with('roomType')->findOrFail($request->room_id);

        $days = max(
            1,
            Carbon::parse($request->check_in)
                ->diffInDays(Carbon::parse($request->check_out))
        );

        $total = $days * $room->roomType->price_per_night;

        Booking::create([
            'user_id'     => $request->user_id,
            'room_id'     => $request->room_id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guest'       => $request->guest,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        $room->update([
            'status' => 'occupied'
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $rooms = Room::with('roomType')->get();

        $customers = User::where('role', 'customer')
            ->orderBy('name')
            ->get();

        return view('admin.bookings.edit', compact(
            'booking',
            'rooms',
            'customers'
        ));
    }

    public function update(Request $request, Booking $booking)
    {
        
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guest'     => 'required|integer|min:1',
            'status'    => 'required|in:pending,confirmed,check_in,check_out,cancelled',
        ]);

        $room = Room::with('roomType')->findOrFail($request->room_id);

        $days = max(
            1,
            Carbon::parse($request->check_in)
                ->diffInDays(Carbon::parse($request->check_out))
        );

        $total = $days * $room->roomType->price_per_night;

        $booking->update([
            'user_id'     => $request->user_id,
            'room_id'     => $request->room_id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guest'       => $request->guest,
            'status'      => $request->status,
            'total_price' => $total,
        ]);

        if (
            $request->status == 'check_out' ||
            $request->status == 'cancelled'
        ) {
            $room->update([
                'status' => 'available'
            ]);
        } else {
            $room->update([
                'status' => 'occupied'
            ]);
        }

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->room) {
            $booking->room->update([
                'status' => 'available'
            ]);
        }

        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}