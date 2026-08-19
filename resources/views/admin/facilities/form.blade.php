<div class="bg-white shadow rounded-lg p-6">

    <div class="mb-4">
        <label class="block font-semibold mb-2">
            Nama Facility
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $facility->name ?? '') }}"
            class="w-full border rounded-lg px-4 py-2"
            required>

        @error('name')
            <small class="text-red-500">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-2">
            Deskripsi
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded-lg px-4 py-2">{{ old('description', $facility->description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-2">
            Gambar
        </label>

        <input
            type="file"
            name="image"
            class="w-full border rounded-lg px-4 py-2">

        @if(isset($facility) && $facility->image)

            <img
                src="{{ asset('storage/'.$facility->image) }}"
                class="w-40 mt-4 rounded">

        @endif

    </div>

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

        Simpan

    </button>

</div>