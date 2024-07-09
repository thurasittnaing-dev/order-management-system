<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderTables extends Model
{
    use HasFactory;
    protected $fillable  = ['table_no', 'max_person', 'active', 'in_used', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function current_order(): HasOne
    {
        return $this->hasOne(Order::class, 'order_table_id', 'id')->where('status', false);
    }
}
