<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\OrderRecipes;
use App\Models\Recipe;

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
        } elseif ($request->has('cancel')) {
            $this->updateOrderStatus($request->recipe_id, 'cancel');
        } elseif ($request->has('ready')) {
            $this->updateOrderStatus($request->recipe_id, 'ready');
        }
    }
}
