@extends('layouts.kitchenlayout')

@section('title', 'History')

@section('page', 'History')

@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-header">Filter</div>
            <form action="{{ route('history') }}" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <input type="date" name="date" class="form-control" placeholder="Date" value="{{ request('date') }}">
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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead class="">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Table No</th>
                            <th scope="col">Recipe Name</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->table_no }}</td>
                                <td>{{ $order->recipe_name }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no order yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
