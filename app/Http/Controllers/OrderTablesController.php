<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderTableStoreRequest;
use App\Models\OrderTables;
use Illuminate\Http\Request;

class OrderTablesController extends Controller
{
    // public function index(){
    //     $order_tables=OrderTables::orderby('created_at','asc')->get();
    //     $order_tables=OrderTables::orderby('created_at','asc')->paginate(3);
    //     $i=(request('page',1)-1)*3;
    //     return view('backend.order_tables.index',compact('order_tables','i'));
    // }
    public function index(Request $request){
        $order_tables = OrderTables::query();
        if ($request->keyword) {
            //search
            $order_tables = $order_tables->where('table_no', 'LIKE', '%' . $request->keyword . '%');
        }
        $order_tables = $order_tables->paginate(4);
        $i = (request('page',1)-1)*4;
        return view ('backend/order_tables.index',compact('order_tables','i'));
    }
    public function create()
    {
        return view('backend.order_tables.create');
    }

    public function store(OrderTableStoreRequest $request)
    {
        dd('heheh');
        $validate=$request->validated();
        $tableNumber = 'TB-' . (OrderTables::count() + 1);
        OrderTables::create([
            'table_no' => $tableNumber,
            'max_person'=>$request->max_person,
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

    public function edit( $id)
    {
        $order_tables = OrderTables::find($id);
        return view('backend.order_tables.edit', compact('order_tables'));
    }

    public function update(Request $request, $id)
    {
        $validate=$request->validated();
        $order_tables = OrderTables::find($id);
        $order_tables->update([
            'table_no' => $request->table_no,
            'max_person'=>$request->max_person,
            'active' => $request->status
        ]);

        return redirect()->route('order_tables.index');
    }

}
