@extends('layouts.orderlayout')

@section('title', 'Make Order')

@section('page', 'Make Order')


@section('content')
    <div class="container-fluid">
        <div class="card checkout-card">
            <div class="row p-0">
                <div class="col-md-9">
                    <div class="recipe-card">
                        <div class="d-flex justify-content-between p-3">
                            <div class="table-no">{{ $orderTable->table_no}}</div>
                            <div>
                                <a href="{{ route('recipes', $orderTable->id) }}" class="btn btn-primary me-1">Add Recipe</a>
                                <a href="" class="btn btn-success">Make Order</a>
                            </div>
                        </div>

                        <div class="my-1 p-2 d-flex" title="Recipe Status Label">
                            <div class="recipe-status-label bg-danger">Not Send</div>
                            <div class="recipe-status-label bg-info">Make Order</div>
                            <div class="recipe-status-label bg-warning">Cooking</div>
                            <div class="recipe-status-label bg-success">Ready</div>
                        </div>

                        @include('order.order_recipes')
                    </div>
                </div>
                <div class="col-md-3">
                    @include('order.invoice_card')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('js')

@endsection
