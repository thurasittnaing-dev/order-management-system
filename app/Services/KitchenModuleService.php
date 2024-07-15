<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderRecipes;
use Illuminate\Pagination\LengthAwarePaginator;

class KitchenModuleService
{
    public function getOrdersForToday()
    {
        $today = date('Y-m-d');
        $recipes = OrderRecipes::with('recipe')->whereDate('created_at', $today)->where('status', 'pending')->get();
        $recipesCount = $recipes->count();
        $confirm = OrderRecipes::with('recipe')->whereDate('created_at', $today)->where('status', 'confirm')->get();
        $confirmCount = $confirm->count();
        $cancel = OrderRecipes::with('recipe')->whereDate('created_at', $today)->where('status', 'cancel')->get();
        $cancelCount = $cancel->count();
        $ready = OrderRecipes::with('recipe')->whereDate('created_at', $today)->where('status', 'ready')->get();
        $readyCount = $ready->count();

        return compact('recipes', 'confirm', 'cancel', 'ready', 'recipesCount', 'confirmCount', 'cancelCount', 'readyCount');
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = OrderRecipes::find($orderId);
        if ($order) {
            $order->status = $status;
            $order->save();
        }
    }

    public function updateStatusFromRequest($request)
    {
        if ($request->has('confirm')) {
            $this->updateOrderStatus($request->recipe_id, 'confirm');
            session()->flash('success', 'Order status confirmed successfully.');
        } elseif ($request->has('cancel')) {
            $this->updateOrderStatus($request->recipe_id, 'cancel');
            session()->flash('success', 'Order status canceled successfully.');
        } elseif ($request->has('ready')) {
            $this->updateOrderStatus($request->recipe_id, 'ready');
            session()->flash('success', 'Order status readied successfully.');
        }
    }

    public function getPaginatedOrdersByDateRange($startDate, $endDate, $invoiceNo = null, $tableNo = null, $perPage = 10)
    {
        $orders = Order::whereHas('orderRecipes', function ($query) {
            $query->where('status', 'ready');
        })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($invoiceNo, function ($query, $invoiceNo) {
                $query->where('invoice_no', 'like', '%' . $invoiceNo . '%');
            })
            ->when($tableNo, function ($query, $tableNo) {
                $query->whereHas('orderTable', function ($query) use ($tableNo) {
                    $query->where('table_no', 'like', '%' . $tableNo . '%');
                });
            })
            ->with(['orderTable', 'orderRecipes.recipe'])
            ->orderBy('created_at', 'desc')
            ->get();

        $result = [];

        foreach ($orders as $order) {
            foreach ($order->orderRecipes as $orderRecipe) {
                if ($orderRecipe->status === 'ready') {
                    $result[] = [
                        'table_no' => $order->orderTable->table_no,
                        'invoice_no' => $order->invoice_no,
                        'recipe_name' => $orderRecipe->recipe->name,
                        'total_quantity' => $orderRecipe->quantity,
                    ];
                }
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($result, ($currentPage - 1) * $perPage, $perPage);
        $paginatedOrders = new LengthAwarePaginator($currentItems, count($result), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return $paginatedOrders;
    }
}
