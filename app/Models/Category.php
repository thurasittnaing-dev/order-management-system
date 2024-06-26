<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'type',
        'description',
    ];
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
