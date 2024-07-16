@extends('layouts.kitchenlayout')

@section('title', 'History')

@section('page', 'History')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="{{ route('history') }}" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="form-row d-flex">
                        <div class="form-group col-md-3 me-3">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="form-group col-md-3 me-3">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ request('end_date') }}">
                        </div>
                        <div class=" mb-3 col-md-2 me-3">
                            <label for="invoice_no">Invoice No</label>
                            <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                value="{{ request('invoice_no') }}">
                        </div>
                        <div class=" mb-3 col-md-2 ">
                            <label for="table_no">Table No</label>
                            <input type="text" class="form-control" id="table_no" name="table_no"
                                value="{{ request('table_no') }}">
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('history') }}" class="btn btn-danger">Clear</a>
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
                        <p class="text-primary">Total Histories: {{ $total_histories }}</p>
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
                                <th scope="col">Table No</th>
                                <th scope="col">Recipe Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td>{{ $order['invoice_no'] }}</td>
                                    <td>{{ $order['table_no'] }}</td>
                                    <td>{{ $order['recipe_name'] }}</td>
                                    <td>{{ $order['date'] }}</td>
                                    <td>{{ $order['quantity'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="6">There is no history yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="4"></td>
                                <td><strong>Total Quantity</strong></td>
                                <td>{{ $total_quantity }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
