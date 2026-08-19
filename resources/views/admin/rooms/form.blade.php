<div class="bg-white rounded-xl shadow p-6 space-y-6">

    {{-- Room Type --}}
    <div>

        <label class="block font-semibold mb-2">
            Room Type
        </label>

        <select
            name="room_type_id"
            class="w-full border rounded-lg p-3">

            <option value="">
                -- Pilih Room Type --
            </option>

            @foreach($roomTypes as $type)

                <option
                    value="{{ $type->id }}"
                    {{ old('room_type_id', $room->room_type_id ?? '') == $type->id ? 'selected' : '' }}>

                    {{ $type->name }}

                </option>

            @endforeach

        </select>

        @error('room_type_id')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

    </div>

    {{-- Room Number --}}
    <div>

        <label class="block font-semibold mb-2">
            Room Number
        </label>

        <input
            type="text"
            name="room_number"
            value="{{ old('room_number', $room->room_number ?? '') }}"
            class="w-full border rounded-lg p-3">

        @error('room_number')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

    </div>

    {{-- Status --}}
    <div>

        <label class="block font-semibold mb-2">
            Status
        </label>

        <select
            name="status"
            class="w-full border rounded-lg p-3">

            <option value="available"
                {{ old('status', $room->status ?? '') == 'available' ? 'selected' : '' }}>
                Available
            </option>

            <option value="booked"
                {{ old('status', $room->status ?? '') == 'booked' ? 'selected' : '' }}>
                Booked
            </option>

            <option value="maintenance"
                {{ old('status', $room->status ?? '') == 'maintenance' ? 'selected' : '' }}>
                Maintenance
            </option>

        </select>

    </div>

    {{-- Upload Gambar --}}
    <div>

        <label class="block font-semibold mb-2">
            Foto Room
        </label>

        <input
            type="file"
            name="image"
            class="w-full border rounded-lg p-3">

        @error('image')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        @isset($room)

            @if($room->image)

                <img
                    src="{{ asset('storage/'.$room->image) }}"
                    class="w-40 mt-4 rounded-lg">

            @endif

        @endisset

    </div>

</div>