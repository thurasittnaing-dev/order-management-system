<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Recipe;

class OrderRecipes extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','recipe_id','quantity','discount','amount','status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

