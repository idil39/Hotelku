<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price_per_night' => 'required|numeric',
            'capacity' => 'required|integer',
        ]);

        RoomType::create($request->all());

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Room Type berhasil ditambahkan');
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price_per_night' => 'required|numeric',
            'capacity' => 'required|integer',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Room Type berhasil diupdate');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()
            ->route('room-types.index')
            ->with('success', 'Room Type berhasil dihapus');
    }
}