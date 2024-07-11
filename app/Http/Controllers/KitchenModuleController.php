<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderRecipes;
use App\Services\KitchenModuleService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class KitchenModuleController extends Controller
{
    protected $kitchenModuleService;

    public function __construct(KitchenModuleService $kitchenModuleService)
    {
        $this->kitchenModuleService = $kitchenModuleService;
    }

    public function orders()
    {
        $data = $this->kitchenModuleService->getOrdersForToday();
        return view('kitchen.order', $data);
    }


    public function updateStatus(Request $request)
    {
        $this->kitchenModuleService->updateStatusFromRequest($request);
        return redirect()->back();
    }


    public function history(Request $request)
    {
        $date = $request->input('date');
        $orders = $this->kitchenModuleService->getOrdersByDate($date);
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($orders, ($currentPage - 1) * $perPage, $perPage);
        $paginatedOrders = new LengthAwarePaginator($currentItems, count($orders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('kitchen.history', [
            'orders' => $paginatedOrders,
            'total_histories' => count($orders),
        ]);
    }
}
