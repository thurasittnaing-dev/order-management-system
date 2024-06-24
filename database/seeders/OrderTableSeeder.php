<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderTables;
use App\Models\Room;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxPersons = [2, 5, 10, 25];
        $rooms = Room::all();

        for ($i = 0; $i < 30; $i++) {
            $room = $rooms->random();
            $data =  [
                'table_no' => generateTableNo(),
                'max_person' => $maxPersons[rand(0, 3)],
                'active' => (bool)rand(0, 1),
                'in_used' => (bool)rand(0, 1),
                'room_id' => $room->id,
            ];
            OrderTables::create($data);
        }
    }
}
