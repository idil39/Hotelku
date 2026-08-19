<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'guest',
        'total_price',
        'status',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    // Booking dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Booking untuk satu Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Booking memiliki satu Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}