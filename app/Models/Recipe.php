<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Ingredient;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','description','category_id','amount','discount','net_amount','is_promotion','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    
    public function calculateDiscountedAmount($discount)
    {
        // Ensure discount is valid and calculate discounted amount
        if ($discount > 0) {
            return $this->amount - $discount;
        }

        // If no discount or invalid discount, return original amount
        return $this->amount;
    }
}
