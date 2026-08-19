<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        RoomType::query()->delete();

        RoomType::create([
            'name' => 'Standard',
            'description' => 'Kamar Standard dengan fasilitas lengkap',
            'price_per_night' => 250000,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name' => 'Deluxe',
            'description' => 'Kamar Deluxe dengan pemandangan kota',
            'price_per_night' => 450000,
            'capacity' => 3,
        ]);

        RoomType::create([
            'name' => 'Suite',
            'description' => 'Kamar Suite terbaik HotelKu',
            'price_per_night' => 800000,
            'capacity' => 4,
        ]);
    }
}