<?php

namespace App\Services;

use App\Models\OrderTables;
use App\Models\Room;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\OrderRecipes;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class OrderModuleService
{
    public function getRooms()
    {
        $query = Room::query();
        return[
            'rooms' => $query->get(),
            'totalRooms' => $query->count(),
            'roomTypes' => Room::select('type')->distinct()->get(),
            'roomsByType' => Room::all()->groupBy('type'),
            'roomCountsByType' => Room::select('type', DB::raw('count(*) as total'))
                                ->groupBy('type')
                                ->pluck('total', 'type'),

        ];
    }

    public function getOrderTables($room)
    {
        $tables = OrderTables::where('room_id', $room)->get();

        return[
            'tables' => $tables,
            'totalTables' => $tables->count(),
            'room' => Room::with('orderTables')->find($room),
            'maxPersons' => $tables->groupBy('max_person')->sortKeys(),

        ];
    }

    public function getMenu($table)
    {
        return[
            'categories' => Category::with('recipes')->get(),
            'orderTable_id' => OrderTables::select('id')->where('id', $table)->first(),

        ];
    }


    public function storeOrder($request, $table, $invoice)
    {
        $validatedData = $request->validated();
        $data = json_decode($validatedData['data']);
        try {

            $order =Order::create([
              'invoice_no' => generateInvoiceNo(),
                'order_table_id'=>$table->id,
                'service_charges'=>$table->room->service_fee,
                'user_id' =>auth()->user()->id,
            ]);

            $totalDiscount = 0;
            $totalAmount = 0;


            foreach ($data as $recipeData) {
                $recipe = Recipe::find($recipeData->id);
                $discount = $recipe->discount * $recipeData->quantity;
                $amount = $recipe->amount * $recipeData->quantity;
                OrderRecipes::create([
                    'order_id' => $order->id,
                    'recipe_id' => $recipe->id,
                    'quantity' => $recipeData->quantity,
                    'discount' => $recipe->discount,
                    'amount' => $recipe->amount,
                ]);

                $totalDiscount += $discount;
                $totalAmount += $amount;
            }

            $netAmount = ($totalAmount + $order->service_charges) - $totalDiscount;

            $order->update([
                'discount' => $totalDiscount,
                'amount' => $totalAmount,
                'net_amount' => $netAmount,
            ]);


            return [
              'invoice'=> $order->invoice_no,
            ];

          } catch (\Exception $e) {
            dd($e);
            return [
              'status' => 'error',
              'message' => 'Something went wrong',
            ];
          }
    }

    public function getOrder($table, $invoice,$order)
    {
        $orderTable = OrderTables::select('id', 'table_no')->where('id', $table)->first();
        $order = Order::select('net_amount')->where('invoice_no',$invoice)->first();

        return[
            'orderTable' => $orderTable,
            'invoice' => $invoice,
            'order' => $order,
        ];
    }
}
