<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderTables;
use App\Models\Room;

class OrderTableSeeder extends Seeder
{
    /**
     *     Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxPersons = [2, 5, 10, 25];
        $tablePerPerson = 5;
        $rooms = Room::all();

        foreach($rooms as $room){
            foreach($maxPersons as $maxPerson){
                for ($i = 0; $i < $tablePerPerson; $i++) {
                    $data =  [
                        'table_no' => generateTableNo(),
                        'max_person' => $maxPerson,
                        'active' => true,
                        'in_used' => false,
                        'room_id' => $room->id,
                    ];
                    OrderTables::create($data);
                }
            }
        }


    }
}

