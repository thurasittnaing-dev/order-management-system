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
        $invoiceNo = $request->input('invoice_no');
        $tableNo = $request->input('table_no');

        $result = $this->kitchenModuleService->getPaginatedOrdersByDateRange($startDate, $endDate, $invoiceNo, $tableNo);

        return view('kitchen.history', [
            'orders' => $result['orders'],
            'total_histories' => $result['orders']->total(),
            'total_quantity' => $result['total_quantity']
        ]);
    }
}
