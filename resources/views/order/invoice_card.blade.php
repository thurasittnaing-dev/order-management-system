
<div class="payment-card p-3">
    <h5>Invoice Information</h5>

    <form action="" class="mt-4" id="checkout-form">
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invocie_no" class="form-control" readonly
                value="{{ is_null($order) ? '' : $order->invoice_no }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" readonly
                value="{{ is_null($order) ? '' : date('d-M-Y', strtotime($order->created_at)) }}">
        </div>
        @if (isset($order))
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" readonly value="{{ $totalNetAmount }}" id="total-amount">
            </div>
        @else
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" readonly value="" id="total-amount">
            </div>
        @endif

        <div class="mb-3">
            <label for="" class="mb-2">Paid Amount</label>
            <input type="number" name="paid_amount" class="form-control mf num-only" value="" id="paid-amount" oninput="calculateChange()">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Change Amount</label>
            <input type="number" name="change_amount" class="form-control mf num-only" value="" id="change-amount" readonly>
        </div>
    </form>

    <script>
        function calculateChange() {
            var totalAmount = {{ $totalNetAmount }};
            var paidAmount = parseFloat($('#paid-amount').val()) || 0;
            var changeAmount = paidAmount - totalAmount;
            $('#change-amount').val(changeAmount.toFixed(2));
        }

    </script>

</div>


{{-- <div class="payment-card p-3">
    <h5>Invoice Information</h5>

    <form action="" class="mt-4" id="checkout-form">
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invocie_no" class="form-control" disabled
                value=" {{ is_null($order) ? '' : $order->invoice_no }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" disabled
                value="{{ is_null($order) ? '' : date('d-M-Y', strtotime($order->created_at)) }}">
        </div>
        @if (isset($order))
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" disabled value="{{ $totalNetAmount }}">
            </div>
        @else
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" disabled value="">
            </div>
        @endif

        <div class="mb-3">
            <label for="" class="mb-2">Paid Amount</label>
            <input type="number" name="paid_amount" class="form-control mf num-only" value="">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Change Amount</label>
            <input type="number" name="change_amount" class="form-control mf num-only" value="">
        </div>
    </form>

    <div class="checkout-footer">
        <div class="d-grid">
            <button id="checkout-btn" type="button" class="btn btn-lg btn-primary"><i class="ti ti-cash-register"></i>
                Checkout</button>
        </div>
    </div>
</div> --}}


