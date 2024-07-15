@extends('layouts.orderlayout')

@section('title', 'Order History')

@section('page', 'Order History')

@section('content')

<div class="container-fluid">
    @php
        $invoice_no = $_GET['invoice_no'] ?? '';
        $room_name = $_GET['room_name'] ?? '';
        $table_no = $_GET['table_no'] ?? '';
        $date = $_GET['datefilter']?? '';
    @endphp
    <div class="card">
        <div class="card-header">Filter</div>
        <form action="{{ route('orderHistory') }}" method="GET" autocomplete="off">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <input type="text" name="invoice_no" class="form-control" placeholder="Invoice No"
                            value="{{ $invoice_no }}">
                    </div>
                    <div class="mb-3 col-md-3">
                        <select id="room_name" class="form-control lib-s2" name="room_name">
                            <option value=" ">Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" @if (request('room_name') == $room->id) selected @endif>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <input type="text" name="table_no" class="form-control" placeholder="Table No"
                            value="{{ $table_no }}">
                    </div>
                    <div class="mb-3 col-md-3">
                        <input type="text" class="form-control" name="datefilter" value="{{ $date }}" placeholder="Select Date" />
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <div>
                    <a href="{{ route('orderHistory') }}" class="btn btn-danger">Clear</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-search me-1"></i>Search
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-primary">Total Order Histories: ({{ $count }})</p>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Room Name</th>
                            <th scope="col">Table No</th>
                            <th scope="col">Date</th>
                            <th scope="col"><center>Action</center></th>

                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($orders as $key => $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->room_name }}</td>
                                <td>{{ $order->table_no }}</td>
                                <td>{{ $order->updated_at->format('d-m-Y') }}</td>
                                <td align="center">
                                    <a href=" {{ route('makeOrder', ['table'=> $order->order_table_id, 'order'=>$order->id]) }}" class="btn btn-secondary" target="_blank">Details</a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no order yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
        {{ $orders->links() }}
    </div>
</div>

@endsection

@section('css')
@endsection

@section('js')
<script type="text/javascript">
    $(function() {

      $('input[name="datefilter"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });

      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

    });
</script>

@endsection
