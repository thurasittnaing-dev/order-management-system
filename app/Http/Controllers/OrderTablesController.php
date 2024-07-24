<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderTableStoreRequest;
use App\Http\Requests\OrderTableUpdateRequest;
use App\Models\OrderTables;
use App\Models\Room;
use App\Services\OrderTableService;
use Illuminate\Http\Request;

class OrderTablesController extends Controller
{
    private $orderTableService;

    public function __construct(OrderTableService $orderTableService)
    {
        $this->middleware('admin');
        $this->orderTableService = $orderTableService;
    }

    public function index()
    {
        $data = $this->orderTableService->index();
        return view('backend/order_tables.index', $data);
    }
    public function create()
    {
        $rooms = Room::get();
        return view('backend.order_tables.create', compact('rooms'));
    }

    public function store(OrderTableStoreRequest $request)
    {
        $data = $this->orderTableService->store($request);
        return redirect()->route('order_tables.index')->with($data['status'], $data['message']);
    }

    public function destroy(OrderTables $order_table)
    {
        $data = $this->orderTableService->destroy($order_table);
        return redirect()->route('order_tables.index')->with($data['status'], $data['message']);
    }

    public function edit(OrderTables $order_table)
    {
        // dd($order_table);
        $rooms = Room::get();
        return view('backend.order_tables.edit', compact('order_table', 'rooms'));
    }

    public function update(OrderTableUpdateRequest $request, OrderTables $order_table)
    {

        $data = $this->orderTableService->update($request, $order_table);
        return redirect()->route('order_tables.index')->with($data['status'], $data['message']);
    }
}