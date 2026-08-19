<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        Facility::truncate();

        $data = [

            ['name'=>'Free WiFi'],
            ['name'=>'Kolam Renang'],
            ['name'=>'Restaurant'],
            ['name'=>'Spa'],
            ['name'=>'Gym'],
            ['name'=>'Parkir Gratis'],

        ];

        foreach($data as $item){

            Facility::create($item);

        }
    }
}