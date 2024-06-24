<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderTables;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'type',
        'service_fee',
    ];

    public function orderTables()
    {
        return $this->hasMany(OrderTables::class);
    }
}
