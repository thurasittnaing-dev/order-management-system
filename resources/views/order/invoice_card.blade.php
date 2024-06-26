<div class="payment-card p-3">
    <h5>Invoice Information</h5>

    <form action="" class="mt-4" id="checkout-form">
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invocie_no" class="form-control" disabled value="INV-0000001">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" disabled value="{{ date('d-M-Y') }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Total Amount</label>
            <input type="number" name="total_amount" class="form-control num-only" disabled value="250000">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Paid Amount</label>
            <input type="number" name="paid_amount" class="form-control mf num-only" value="300000">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Change Amount</label>
            <input type="number" name="change_amount" class="form-control mf num-only" value="50000">
        </div>
    </form>

    <div class="checkout-footer">
        <div class="d-grid">
            <button id="checkout-btn" type="button" class="btn btn-lg btn-primary"><i class="ti ti-cash-register"></i>
                Checkout</button>
        </div>
    </div>
</div>
