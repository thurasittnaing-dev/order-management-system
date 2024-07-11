<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderRecipes;
use App\Models\OrderTables;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

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


    public function getOrdersByDate($date)
    {
        $orders = Order::whereHas('orderRecipes', function ($query) {
            $query->where('status', 'ready');
        })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->with(['orderTable', 'orderRecipes.recipe'])
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

        return $result;
    }
}
