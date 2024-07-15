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
        return [
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
        $tables = OrderTables::with('current_order')->where('room_id', $room)->get();
        return [
            'tables' => $tables,
            'totalTables' => $tables->count(),
            'room' => Room::with('orderTables')->find($room),
            'maxPersons' => $tables->groupBy('max_person')->sortKeys(),

        ];
    }

    public function getMenu($table, $order)
    {
        // dd($table, $order);
        return [
            'categories' => Category::with('recipes')->get(),
            'orderTable_id' => $table,
            'order' => $order,
        ];
    }


    public function storeOrder($request, $table, $orderData)
    {
        $validatedData = $request->validated();
        $data = json_decode($validatedData['data']);
        $order_id = '';

        DB::beginTransaction();

        try {
            if (is_null($orderData)) {
                $order = Order::create([
                    'invoice_no' => generateInvoiceNo(),
                    'order_table_id' => $table->id,
                    'service_charges' => $table->room->service_fee,
                    'user_id' => auth()->user()->id,
                ]);

                $order_id = $order->id;

                foreach ($data as $recipeData) {
                    $recipe = Recipe::find($recipeData->id);

                    OrderRecipes::create([
                        'order_id' => $order->id,
                        'recipe_id' => $recipe->id,
                        'quantity' => $recipeData->quantity,
                        'discount' => $recipe->discount *  $recipeData->quantity,
                        'amount' => $recipe->amount *  $recipeData->quantity,
                    ]);
                }
            } else {
                $order_id = $orderData->id;

                foreach ($data as $recipeData) {
                    $recipe = Recipe::find($recipeData->id);

                    OrderRecipes::create([
                        'order_id' => $orderData->id,
                        'recipe_id' => $recipe->id,
                        'quantity' => $recipeData->quantity,
                        'discount' => $recipe->discount *  $recipeData->quantity,
                        'amount' => $recipe->amount *  $recipeData->quantity,
                    ]);
                }
            }

            DB::commit();
            return [
                'status' => 'order-success',
                'message' => 'Success',
                'order_id' => $order_id
            ];
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
            ];
        }
    }

    public function updateOrder($request, $order)
    {
        DB::beginTransaction();

        try {
            $order->update([
                'discount' => $request->input('total_discount'),
                'amount' => $request->input('total_amount'),
                'service_charges' => $request->input('service_fee'),
                'net_amount' => $request->input('total_net_amount'),
                'paid' => $request->input('paid_amount'),
                'change' => $request->input('change_amount'),
                'status' => true,
            ]);

            DB::commit();
            return [
                'status' => 'update-success',
                'message' => 'Success',
            ];
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return [
                'status' => 'error',
                'message' => 'Something went wrong',
            ];
        }
    }

    public function getInuseTable()
    {
        $query = OrderTables::query();
        $tables = $query->get();
        return [
            'tables' => $tables,
            'totalTables' => $query->count(),
            'maxPersons' => $tables->groupBy('max_person')->sortKeys(),
        ];
    }

    public function getOrderHistory()
    {
        $query = Order::query()
            ->when(request('invoice_no'), fn($query) => $query->where('invoice_no', 'LIKE', '%' . request('invoice_no') . '%'))
            ->when(request('room_name'), function($query) {
                $query->whereHas('orderTable', function($query) {
                    $query->where('room_id', request('room_name'));
                });
            })
            ->when(request('table_no'), function($query) {
                $query->whereHas('orderTable', function($query) {
                    $query->where('table_no', 'LIKE', '%' . request('table_no') . '%');
                });
            });
        $totalCount = $query->count();
        $orders = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();
        foreach ($orders as $order) {
            $tableId = $order->order_table_id;
            $orderTable = OrderTables::find($tableId);
            $order->room_name = $orderTable->room->name;
            $order->table_no = $orderTable->table_no;
        }
        $rooms = Room::all();

        return [
            'i' => getTableIndexer(5),
            'count' => $totalCount,
            'orders' => $orders,
            'rooms' => $rooms,
        ];
    }
}