<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderRecipes;
use Illuminate\Routing\Controller;

class KitchenModuleController extends Controller
{
    public function orders()
    {

        $orders = Order::where('status', 'pending')->count();
        return view('kitchen.order', ['count' => $orders]);
    }
    public function status(Request $request){
        $request->validate([
            'order_id' => 'required|exists:order_recipes,id',
            'status' => 'required|in:confirm,cancel,ready',
        ]);
        $orderRecipe = OrderRecipes::find($request->order_id);
        $orderRecipe->status = $request->status;
        $orderRecipe->save();
        return redirect()->route('orders')->with('success', 'Order status updated successfully!');

    }

}
