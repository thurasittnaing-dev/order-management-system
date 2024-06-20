<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderTableStoreRequest;
use App\Http\Requests\OrderTableUpdateRequest;
use App\Models\OrderTables;
use App\Services\OrderTableService;
use Illuminate\Http\Request;

class OrderTablesController extends Controller
{
    private $orderTableService;

    public function __construct(OrderTableService $orderTableService)
    {
        $this->orderTableService = $orderTableService;
    }

    public function index()
    {
        $data = $this->orderTableService->index();
        return view('backend/order_tables.index', $data);
    }
    public function create()
    {
        return view('backend.order_tables.create');
    }

    public function store(OrderTableStoreRequest $request)
    {
        $data = $this->orderTableService->store($request);
        return redirect()->route('order_tables.index')->with($data['status'], $data['message']);
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
