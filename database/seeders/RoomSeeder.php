<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [

            [
                'room_type_id' => 1,
                'room_number' => '101',
            ],
            [
                'room_type_id' => 1,
                'room_number' => '102',
            ],
            [
                'room_type_id' => 1,
                'room_number' => '103',
            ],

            [
                'room_type_id' => 2,
                'room_number' => '201',
            ],
            [
                'room_type_id' => 2,
                'room_number' => '202',
            ],
            [
                'room_type_id' => 2,
                'room_number' => '203',
            ],

            [
                'room_type_id' => 3,
                'room_number' => '301',
            ],
            [
                'room_type_id' => 3,
                'room_number' => '302',
            ],

        ];

        foreach ($rooms as $room) {

            $image = match ($room['room_type_id']) {
                1 => 'images/rooms/standard.jpg',
                2 => 'images/rooms/deluxe.jpg',
                3 => 'images/rooms/suite.jpg',
            };

            Room::updateOrCreate(
                [
                    'room_number' => $room['room_number'],
                ],
                [
                    'room_type_id' => $room['room_type_id'],
                    'status'       => 'available',
                    'image'        => $image,
                ]
            );

        }
    }
}