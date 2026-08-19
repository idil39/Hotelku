<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')
            ->latest()
            ->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::orderBy('name')->get();

        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|string|max:20|unique:rooms,room_number',
            'status'       => 'required|in:available,occupied,maintenance',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::orderBy('name')->get();

        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|string|max:20|unique:rooms,room_number,' . $room->id,
            'status'       => 'required|in:available,occupied,maintenance',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }

            $validated['image'] = $request->file('image')->store('rooms', 'public');

        } else {

            $validated['image'] = $room->image;

        }

        $room->update($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->image && Storage::disk('public')->exists($room->image)) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room berhasil dihapus.');
    }
}