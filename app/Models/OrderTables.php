<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class OrderTables extends Model
{
    use HasFactory;
    protected $fillable  = ['table_no', 'max_person', 'active','in_used','room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
