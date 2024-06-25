<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','description','category_id','amount','discount','net_amount','is_promotion','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
