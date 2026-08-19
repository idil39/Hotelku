<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Nonaktifkan Foreign Key sementara
        Schema::disableForeignKeyConstraints();

        $this->call([
            AdminSeeder::class,
            CustomerSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            FacilitySeeder::class,
        ]);

        // Aktifkan kembali Foreign Key
        Schema::enableForeignKeyConstraints();
    }
}