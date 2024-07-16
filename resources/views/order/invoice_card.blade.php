

<div class="payment-card p-3">
    <form id="checkout-form"  method="POST" action="{{ route('checkout', ['order' => $order ? $order->id : null]) }}" class="mt-4" >
        @csrf
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invoice_no" class="form-control" disabled
                value="{{ $order ? $order->invoice_no : '' }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" disabled
                value="{{ $order ? date('d-M-Y', strtotime($order->created_at)) : '' }}">
        </div>

        @if ($order)
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_net_amount" class="form-control num-only" readonly value="{{ $totalNetAmount }}" id="total-net-amount">
            </div>
        @else
            <div class="mb-3">
                <label for="" class="mb-2">Total Amount</label>
                <input type="number" name="total_net_amount" class="form-control num-only" readonly value="" id="total-net-amount">
            </div>
        @endif
        @if ($order == null || $order->status == false )
            <div class="mb-3">
                <label for="" class="mb-2">Paid Amount</label>
                <input type="number" name="paid_amount" class="form-control mf num-only" value="" id="paid-amount">
            </div>
            <div class="mb-3">
                <label for="" class="mb-2">Change Amount</label>
                <input type="number" name="change_amount" class="form-control mf num-only" value="" id="change-amount" readonly>
            </div>
            <div>
                <input type="hidden" name="total_amount" value="{{ $totalAmount }}" id="total-amount">
                <input type="hidden" name="total_discount"  value="{{ $totalDiscount }}" id="total-discount">
                <input type="hidden" name="service_fee"  value="{{ $serviceFee }}" id="service-fee">
            </div>
            <div class="checkout-footer">
                <div class="d-grid">
                    <button id="checkout-btn" type="submit" class="btn btn-lg btn-primary" disabled><i class="ti ti-cash-register"></i> Checkout</button>
                </div>
            </div>
        @else
            <div class="mb-3">
                <label for="" class="mb-2">Paid Amount</label>
                <input type="number" name="paid_amount" class="form-control mf num-only" value="{{ $order ? $order->paid : 0 }}" id="paid-amount" disabled>
            </div>
            <div class="mb-3">
                <label for="" class="mb-2">Change Amount</label>
                <input type="number" name="change_amount" class="form-control mf num-only" value="{{ $order ? $order->change : 0 }}" id="change-amount" disabled>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control mf bg-success text-light" value=" Successfully Checkout " readonly>
            </div>
        @endif
    </form>
</div>




