<?php

namespace App\Services;

use App\Models\Room;
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
}
