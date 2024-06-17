<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTables extends Model
{
    use HasFactory;
    protected $fillable  = ['table_no','max_person' ,'active'];


}
