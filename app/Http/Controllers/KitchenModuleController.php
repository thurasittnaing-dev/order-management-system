<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Routing\Controller;

class KitchenModuleController extends Controller
{
    public function orders()
    {
        return view('kitchen.order');
    }
    public function confirm()
    {
        return view('kitchen.confirm');
    }

    public function confirmItem(Request $request)
    {
        dd('hhh');
        // Validate the request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Simulate finding and updating an item
        $itemId = $request->input('id');
        // $item = Item::find($itemId);
        // $item->status = 'confirmed';
        // $item->save();

        return response()->json(['success' => true]);
    }
}
