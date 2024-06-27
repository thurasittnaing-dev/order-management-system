<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_no','order_table_id','discount','amount','service_charges','net_amount','paid','change','status','user_id'];
}
