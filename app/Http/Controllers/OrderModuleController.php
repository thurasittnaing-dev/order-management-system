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
        $data = $this->orderModuleService->getRooms();
        return view('order.rooms', $data);
    }

    public function tables($room)
    {

        $data = $this->orderModuleService->getOrderTables($room);
        return view('order.tables', $data);
    }

    public function recipes($table , $invoice = null)
    {
        $data = $this->orderModuleService->getMenu();
        return view('order.recipes',$data);
    }
    public function makeOrder($table, $invoice = null)
    {
        dd($table, $invoice);
    }
}
