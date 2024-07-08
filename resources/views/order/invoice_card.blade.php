<div class="payment-card p-3">
    <h5>Invoice Information</h5>

    <form action="" class="mt-4" id="checkout-form">
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invocie_no" class="form-control" disabled value=" {{ is_null($order) ? '' : $order->invoice_no }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" disabled value="{{ is_null($order) ? '' : date('d-M-Y',strtotime($order->created_at)) }}">
        </div>
        @if(isset($order))
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" disabled value=" ">
            </div>
        @else
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_amount" class="form-control num-only" disabled value=" ">
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
</div>
