<?php

namespace App\Http\Controllers;


use App\Services\OrderModuleService;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Models\OrderTables;
use App\Models\Order;

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

    public function recipes($table, Order $order = null)
    {
        $data = $this->orderModuleService->getMenu($table, $order);
        return view('order.recipes', $data);
    }

    public function store(OrderStoreRequest $request, OrderTables $table, Order $order = null)
    {
        $data = $this->orderModuleService->storeOrder($request, $table, $order);
        $orderData = Order::find($data['order_id']);
        return redirect()->route('makeOrder', ['table' => $table->id, 'order' => $orderData])
            ->with($data['status'], $data['message']);
    }

    public function makeOrder(OrderTables $table, Order $order = null)
    {
        $serviceFee =  $table->room->service_fee;
        // $totalAmount =  is_null($order) ? 0 : $order->orderRecipes->sum('amount');
        // $totalDiscount =   is_null($order) ? 0 : $order->orderRecipes->sum('discount');

        $totalAmount = is_null($order) ? 0 : $order->orderRecipes->filter(function($orderRecipe) {
            return $orderRecipe->status !== 'cancel';
        })->sum('amount');

        $totalDiscount = is_null($order) ? 0 : $order->orderRecipes->filter(function($orderRecipe) {
            return $orderRecipe->status !== 'cancel';
        })->sum('discount');


        return view('order.make_order', [
            'orderTable' => $table,
            'order' => !is_null($order) ? $order->load(['orderRecipes', 'orderRecipes.recipe']) : null,
            'totalDiscount' => $totalDiscount,
            'totalAmount' =>  $totalAmount,
            'serviceFee' => $serviceFee,
            'totalNetAmount' => ($serviceFee + $totalAmount) - $totalDiscount,
        ]);
    }

    public function checkout(Request $request, Order $order = null)
    {
        $data = $this->orderModuleService->updateOrder($request, $order);
        $table = $order->order_table_id;
        return redirect()->route('makeOrder', ['table' => $table, 'order' => $order]);
    }
    public function inuseTable()
    {
        $data = $this->orderModuleService->getInuseTable();
        return view('order.inuse_table', $data);
    }
    public function orderHistory(Request $request)
    {
        $data = $this->orderModuleService->getOrderHistory($request);
        return view('order.order_history', $data);
    }
}
