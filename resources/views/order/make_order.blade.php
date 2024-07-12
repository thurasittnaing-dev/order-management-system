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
                            <div class="table-no">{{ $orderTable->table_no }}</div>
                            <div class="d-flex justify-content-between align-items-right">
                                @if(!$order || $order->status == false )
                                    <a href="{{ route('recipes', ['table' => $orderTable, 'order' => $order]) }}"
                                        class="btn btn-primary me-1">Add Recipe</a>
                                    <form id="recipe-form"
                                        action="{{ route('storeOrder', ['table' => $orderTable, 'order' => $order ? $order->id : null]) }} "
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="data" id="data" value="">
                                        <button class="btn btn-success make-order-btn" id="make-order-button"
                                            type="">Make Order</button>
                                    </form>
                                @else
                                    <a href="{{ route('invoices.show', $order->id) }}" id="invoice-btn" class="btn btn-primary me-1">Invoice</a>
                                @endif
                            </div>
                        </div>

                        <div class="my-1 p-2 d-flex" title="Recipe Status Label">
                            <div class="recipe-status-label bg-danger">Not Send</div>
                            <div class="recipe-status-label bg-info">Pending</div>
                            <div class="recipe-status-label bg-warning">Cooking</div>
                            <div class="recipe-status-label bg-success">Ready</div>
                        </div>
                        @php
                            $serviceCharges = $table->room->service_fee ?? 0;
                        @endphp

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
    <script>
        @if (Session::has('order-success'))
            localStorage.removeItem('selectedRecipes');
        @endif

        $(document).ready(function() {
            function toggleMakeOrderButton() {
                var recipes = localStorage.getItem('selectedRecipes');
                var hasRecipes = recipes && JSON.parse(recipes).length >= 1;

                $('#make-order-button').prop('disabled', !hasRecipes);
            }
            toggleMakeOrderButton();
            $('#make-order-button').on('click', function() {
                var recipes = localStorage.getItem('selectedRecipes');
                var hasRecipes = recipes && JSON.parse(recipes).length >= 1;
                if (hasRecipes) {
                    $('#recipe-form').submit();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Make Order Success',
                        showConfirmButton: true,
                        timer: 2000
                    });
                }
            });
            var originalSetItem = localStorage.setItem;
            var originalRemoveItem = localStorage.removeItem;

            localStorage.setItem = function(key, value) {
                originalSetItem.apply(this, arguments);
                if (key === 'selectedRecipes') {
                    toggleMakeOrderButton();
                }
            };
            localStorage.removeItem = function(key) {
                originalRemoveItem.apply(this, arguments);
                if (key === 'selectedRecipes') {
                    toggleMakeOrderButton();
                }
            };
        });

        $(document).ready(function() {
            $('#invoice-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default behavior of the link

                // Open the invoice page in a new window/tab
                var url = $(this).attr('href');
                var newWindow = window.open(url, '_blank');

                // Check if the new window opened successfully
                if (newWindow) {
                    // Wait for the new window to load and then print
                    $(newWindow).on('load', function() {
                        newWindow.print();
                    });
                }
            });
        });



    </script>
@endsection
