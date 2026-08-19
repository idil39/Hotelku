<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email'=>'customer@gmail.com'],
            [
                'name'=>'Customer',
                'password'=>Hash::make('password'),
                'role'=>'customer',
            ]
        );
    }
}