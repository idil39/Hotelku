<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $roomTypes = RoomType::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'description'      => 'nullable|string',
            'price_per_night'  => 'required|numeric|min:0',
            'capacity'         => 'required|integer|min:1',
        ]);

        RoomType::create($validated);

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type berhasil ditambahkan.');
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'description'      => 'nullable|string',
            'price_per_night'  => 'required|numeric|min:0',
            'capacity'         => 'required|integer|min:1',
        ]);

        $roomType->update($validated);

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type berhasil diperbarui.');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type berhasil dihapus.');
    }
}