<?php

namespace App\Services;

use App\Models\OrderTables;
use App\Models\Room;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class OrderModuleService
{
    public function getRooms()
    {
        $query = Room::query();
        return[
            'rooms' => $query->get(),
            'totalRooms' => $query->count(),
            'roomTypes' => Room::select('type')->distinct()->get(),
            'roomsByType' => Room::all()->groupBy('type'),
            'roomCountsByType' => Room::select('type', DB::raw('count(*) as total'))
                                ->groupBy('type')
                                ->pluck('total', 'type'),

        ];
    }

    public function getOrderTables($room)
    {
        $tables = OrderTables::where('room_id', $room)->get();

        return[
            'tables' => $tables,
            'totalTables' => $tables->count(),
            'room' => Room::with('orderTables')->find($room),
            'maxPersons' => $tables->groupBy('max_person')->sortKeys(),

        ];
    }

    public function getMenu($table)
    {
        return[
            'categories' => Category::all(),
        ];
    }

    public function getOrder($table)
    {

        return[
            'orderTable' => OrderTables::select('id','table_no')->where('id', $table)->first(),
        ];
    }
}
