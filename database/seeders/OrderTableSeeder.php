<?php

namespace Database\Seeders;

use App\Models\OrderTables;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0;$i<30;$i++){
            $order_tables =[
                ['table_no' => generateTableNo(),
                'max_person' =>'21',
                'active' =>'1'
                ]
            ];
            foreach($order_tables as $order_table){
                OrderTables::create($order_table);
            }
        }
    }
}
