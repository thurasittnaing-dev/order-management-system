<?php

namespace App\Http\Controllers;

use App\Services\KitchenModuleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $paginatedOrders = $this->kitchenModuleService->getPaginatedOrdersByDateRange($startDate, $endDate);

        return view('kitchen.history', [
            'orders' => $paginatedOrders,
            'total_histories' => $paginatedOrders->total(),
        ]);
    }
}
