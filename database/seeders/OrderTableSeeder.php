<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderTables;

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

        for ($i = 0; $i < 30; $i++) {
            $data =  [
                'table_no' => generateTableNo(),
                'max_person' => $maxPersons[rand(0, 3)],
                'active' => true
            ];
            OrderTables::create($data);
        }
    }
}
