<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRecipes extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','recipe_id','discount','amount','status'];
}

