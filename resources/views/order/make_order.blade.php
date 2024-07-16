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

        //js code for make_order btn
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

        //js code for invoice btn
        $(document).ready(function() {
            $('#invoice-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default behavior of the link
                var url = $(this).attr('href');
                var newWindow = window.open(url, '_blank');
                if (newWindow) {
                    $(newWindow).on('load', function() {
                        newWindow.print();
                    });
                }
            });
        });


        //js code for invoice_card

        $(document).ready(function() {
            // Calculate change amount when paid amount changes
            $('#paid-amount').on('input', function() {
                calculateChange();
            });

            // Calculate change amount when checkout button is clicked
            $('#checkout-btn').on('click', function(event) {
                event.preventDefault();
                calculateChange();

                if (isAnyRecipeReady()) {
                    // Enable form submission for valid checkout
                    $('#checkout-form').submit();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: " Successfully Checkout ",
                        showConfirmButton: true,
                        timer: 2000
                    });
                } else {
                    // Show confirmation dialog for checkout
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to proceed with the checkout?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, checkout',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enable form submission on confirmation
                            $('#checkout-form').submit();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: " Successfully Checkout ",
                                showConfirmButton: true,
                                timer: 2000
                            });
                        }
                    });
                }
            });

            // Function to calculate change amount
            function calculateChange() {
                var totalNetAmount = {{ $totalNetAmount }};
                var paidAmount = parseFloat($('#paid-amount').val()) || 0;
                var changeAmount = paidAmount - totalNetAmount;

                // Display change amount (optional)
                $('#change-amount').val(Math.round(changeAmount));

                // Enable or disable checkout button based on paid amount
                if (paidAmount < totalNetAmount) {
                    $('#change-amount').val('');
                    $('#checkout-btn').prop('disabled', true);
                } else {
                    $('#change-amount').val(Math.round(changeAmount));
                    $('#checkout-btn').prop('disabled', false);
                }
            }

            // Function to check if any recipe is ready
            function isAnyRecipeReady() {
                let hasReadyRecipe = false;
                $('tr[data-status]').each(function() {
                    if ($(this).data('status') === 'ready') {
                        hasReadyRecipe = true;
                        return false; // break the loop
                    }
                });
                return hasReadyRecipe;
            }
        });

    </script>

@endsection
