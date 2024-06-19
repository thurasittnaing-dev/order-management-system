<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderTableStoreRequest;
use App\Http\Requests\OrderTableUpdateRequest;
use App\Models\OrderTables;
use Illuminate\Http\Request;

class OrderTablesController extends Controller
{

    public function index(Request $request)
    {
        $order_tables = OrderTables::query();
        if ($request->table_no != '') {
            //search
            $order_tables = $order_tables->where('table_no', 'LIKE', '%' . $request->table_no . '%');
        }
        if ($request->status != '') {
            // dd($request->status);
            $order_tables->where('active', $request->status);
        }

        $order_tables = $order_tables->paginate(4);
        $i = (request('page', 1) - 1) * 4;
        $count = OrderTables::count();
        return view(
            'backend/order_tables.index',
            [
                'order_tables ' => $order_tables,
                'count' => $count
            ],
            compact('order_tables', 'i')
        );
    }
    public function create()
    {
        return view('backend.order_tables.create');
    }

    public function store(OrderTableStoreRequest $request)
    {
        $validate = $request->validated();
        OrderTables::create([
            'table_no' => generateTableNo(),
            'max_person' => $request->max_person,
            'active' => $request->status
        ]);

        return redirect()->route('order_tables.index');
    }

    public function destroy($id)
    {

        // $order_tables->delete();
        OrderTables::destroy($id);
        return redirect()->route('order_tables.index');
    }

    public function edit($id)
    {

        $order_tables = OrderTables::find($id);
        return view('backend.order_tables.edit', compact('order_tables'));
    }

    public function update(OrderTableUpdateRequest $request, $id)
    {
        $validate = $request->validated();
        $order_tables = OrderTables::find($id);
        $order_tables->update([
            'max_person' => $request->max_person,
            'active' => $request->status
        ]);

        return redirect()->route('order_tables.index');
    }
}
