<?php

namespace App\Http\Controllers;


use App\Services\OrderModuleService;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Models\OrderTables;

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
        $data = $this->orderModuleService->getMenu($table);
        return view('order.recipes',$data);
    }

    public function store(OrderStoreRequest $request, OrderTables $table , $invoice = null)
    {
        // $data = json_decode($request->data);
        // dd($data,$table->room->service_fee,$table->id,auth()->user()->id);
        $data = $this->orderModuleService->storeOrder($request,$table, $invoice);
        $invoice = $data['invoice'] ?? $invoice;
        return redirect()->route('makeOrder',['table' => $table->id, 'invoice' => $invoice])->with($data);

    }


    public function makeOrder($table , $invoice = null ,$order=null)
    {
        $data = $this->orderModuleService->getOrder($table, $invoice,$order);
        return view('order.make_order',$data);
    }
}
