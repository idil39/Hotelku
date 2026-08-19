<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->paginate(10);

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        Facility::create($validated);

        return redirect()
            ->route('admin.facilities.index')
            ->with('success', 'Facility berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        $facility->update($validated);

        return redirect()
            ->route('admin.facilities.index')
            ->with('success', 'Facility berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()
            ->route('admin.facilities.index')
            ->with('success', 'Facility berhasil dihapus.');
    }
}