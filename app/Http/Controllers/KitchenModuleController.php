<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Routing\Controller;

class KitchenModuleController extends Controller
{
    public function orders()
    {
        return view('kitchen.order');
    }

}
