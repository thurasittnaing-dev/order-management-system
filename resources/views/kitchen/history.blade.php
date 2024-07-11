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
                        <div class="form-group col-md-3 me-2">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ request('start_date') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ request('end_date') }}">
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
                                <th scope="col">Table No</th>
                                <th scope="col">Recipe Name</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td>{{ $order['table_no'] }}</td>
                                    <td>{{ $order['recipe_name'] }}</td>
                                    <td>{{ $order['invoice_no'] }}</td>
                                    <td>{{ $order['total_quantity'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="5">There is no history yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
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
