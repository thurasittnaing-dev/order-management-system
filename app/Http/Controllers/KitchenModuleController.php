<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderRecipes;
use App\Services\KitchenModuleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class KitchenModuleController extends Controller
{
    // protected $kitchenModuleService;

    // public function __construct(KitchenModuleService $kitchenModuleService)
    // {
    //     $this->kitchenModuleService = $kitchenModuleService;
    // }
    // public function orders()
    // {
    //     $recipes = OrderRecipes::with('recipe')->get();
    //     return view('kitchen.order',compact('recipes'));
    // }
    public function orders()
    {
        $recipes = OrderRecipes::with('recipe')->where('status', 'pending')->get();
        $confirm = OrderRecipes::with('recipe')->where('status', 'confirm')->get();
        $cancel  = OrderRecipes::with('recipe')->where('status', 'cancel')->get();
        $ready   = OrderRecipes::with('recipe')->where('status', 'ready')->get();
        return view('kitchen.order', compact('recipes','confirm','cancel','ready'));
    }

    public function updateStatus(Request $request)
    {
        $order = OrderRecipes::find($request->recipe_id);
        if ($order) {
            // Update the status based on the button clicked
            if ($request->has('confirm')) {
                $order->status = 'confirm';
            } elseif ($request->has('cancel')) {
                $order->status = 'cancel';
            } elseif ($request->has('ready')) {
                $order->status = 'ready';
            }


            $order->save();
        }
        return redirect()->back();
    }


    // public function status(Request $request, OrderRecipes $orderRecipes)
    // {
    //     $orderRecipes = OrderRecipes::all();
    // }
}
