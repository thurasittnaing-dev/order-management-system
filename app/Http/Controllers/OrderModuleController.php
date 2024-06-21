<?php

namespace App\Http\Controllers;

use App\Services\OrderModuleService;
use Illuminate\Http\Request;

class OrderModuleController extends Controller
{
    protected $orderModuleService;

    public function __construct(OrderModuleService $orderModuleService)
    {
        $this->orderModuleService = $orderModuleService;
    }

    public function rooms()
    {
        return view('order.rooms');
    }

    public function tables($room)
    {
        return view('order.tables');
    }
}
