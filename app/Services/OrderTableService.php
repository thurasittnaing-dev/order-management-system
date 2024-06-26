<?php

namespace App\Services;

use App\Http\Requests\OrderTableUpdateRequest;
use App\Models\OrderTables;
use App\Models\Room;
use PhpParser\Node\Stmt\TryCatch;

class OrderTableService
{
  public function index()
  {
    $query = OrderTables::query();

    // ->when(request('table_no'), fn ($q) => $q->where('table_no', 'LIKE', '%' . request('table_no') . '%'));

    if (request('table_no') != '') {
      $query = $query->where('table_no', 'LIKE', '%' . request('table_no') . '%');
    }
    if (request('max_person') != '') {
      $query = $query->where('max_person', request('max_person'));
    }

    if (request('status') != '') {
      $query->where('active', request('status'));
    }
    if (request('room') != '') {
      $query = $query->whereHas('room', function ($q) {
        $q->where('id', request('room'));
      });
    }
    if (request('in_used') != '') {
      $query->where('in_used', request('in_used'));
    }


    return [
      'i' => getTableIndexer(5),
      'count' => $query->count(),
      'maxPersons' => OrderTables::groupBy('max_person')->pluck('max_person')->toArray(),
      'rooms' => Room::get(['id', 'name']),
      'order_tables' => $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
    ];
  }

  public function store($request)
  {
    try {
      OrderTables::create([
        'table_no' => generateTableNo(),
        'max_person' => $request->max_person,
        'active' => $request->status,
        'in_used' => $request->in_used,
        'room_id' => $request->room,
      ]);

      return [
        'status' => 'success',
        'message' => 'Order Table Created.',
      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong',
      ];
    }
  }
  public function destroy(OrderTables $orderTables)
  {
    try {

      $orderTables->delete();
      return [
        'status' => 'success',
        'message' => 'Order Table Deleted.',
      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong',

      ];
    }
  }
  public function update($request, $order_table)
  {
    try {
      $data = [
        'max_person' => $request->max_person,
        'active' => $request->status,
        'in_used' => $request->in_used,
        'room_id' => $request->room,
      ];

      $order_table->update($data);
      return [
        'status' => 'success',
        'message' => 'Sucessfully Updated.',

      ];
    } catch (\Exception $e) {
      return [
        'status' => 'error',
        'message' => 'Something went wrong!',

      ];
    }
  }
}
