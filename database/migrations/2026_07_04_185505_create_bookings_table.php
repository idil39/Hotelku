<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();

            // Customer yang melakukan booking
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Kamar yang dibooking
            $table->foreignId('room_id')
                ->constrained()
                ->cascadeOnDelete();

            // Tanggal check in
            $table->date('check_in');

            // Tanggal check out
            $table->date('check_out');

            // Jumlah tamu
            $table->unsignedInteger('guest');

            // Total harga booking
            $table->decimal('total_price', 12, 2)->default(0);

            // Status booking
            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};