

<div class="payment-card p-3">
    <form action="{{ route('checkout', ['order' => $order ? $order->id : null]) }}" method="POST" class="mt-4" id="checkout-form">
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
                    <button id="checkout-btn" type="submit" class="btn btn-lg btn-primary"><i class="ti ti-cash-register"></i> Checkout</button>
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

<script src="{{ asset('modernize/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Calculate change amount when paid amount changes
        $('#paid-amount').on('input', function() {
            calculateChange();
        });

        // Calculate change amount when checkout button is clicked
        $('#checkout-btn').on('click', function() {
            calculateChange();
            var order_id = {{ $order ? $order->id : 'null' }};
            window.location.href = '/checkout/' + order_id;
        });

        function calculateChange() {
            var totalAmount = {{ $totalAmount }};
            var totalDiscount = {{ $totalDiscount }};
            var serviceFee = {{$serviceFee}};
            var totalNetAmount = {{ $totalNetAmount }};
            var paidAmount = parseFloat($('#paid-amount').val()) || 0;
            var changeAmount = paidAmount - totalNetAmount;
            console.log('Change Amount:', changeAmount);
            $('#change-amount').val(changeAmount.toFixed(2));
        }
    });
</script>




{{-- <div class="payment-card p-3">
    <form action="{{ route('checkout', ['order' => $order ? $order->id : null]) }}" method="POST" class="mt-4" id="checkout-form">
        @csrf
        <div class="mb-3">
            <label for="" class="mb-2">Invoice No</label>
            <input type="text" name="invocie_no" class="form-control" disabled
                value="{{ is_null($order) ? '' : $order->invoice_no }}">
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Invoice Date</label>
            <input type="text" name="date" class="form-control" disabled
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
            <input type="number" name="paid_amount" class="form-control mf num-only" value="" id="paid-amount" >
        </div>

        <div class="mb-3">
            <label for="" class="mb-2">Change Amount</label>
            <input type="number" name="change_amount" class="form-control mf num-only" value="" id="change-amount" readonly>
        </div>
    </form>

    <div class="checkout-footer">
        <div class="d-grid">
            <button id="checkout-btn" type="submit" class="btn btn-lg btn-primary"><i class="ti ti-cash-register"></i> Checkout</button>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#paid-amount').on('input', function() {
            calculateChange();
        });

        // Optional: Calculate change on button click
        $('#checkout-btn').on('click', function() {
            calculateChange();
        });

        function calculateChange() {
            var totalAmount = {{ $totalNetAmount }};
            var paidAmount = parseFloat($('#paid-amount').val()) || 0;
            var changeAmount = paidAmount - totalAmount;
            $('#change-amount').val(changeAmount.toFixed(2));
        }
    });
</script> --}}


    {{-- <div class="payment-card p-3">
        <h5>Invoice Information</h5>

        <form action="{{ route('checkout', $order) }}" method="POST" class="mt-4" id="checkout-form">
            @csrf
            <div class="mb-3">
                <label for="" class="mb-2">Invoice No</label>
                <input type="text" name="invocie_no" class="form-control" disabled
                    value="{{ is_null($order) ? '' : $order->invoice_no }}">
            </div>

            <div class="mb-3">
                <label for="" class="mb-2">Invoice Date</label>
                <input type="text" name="date" class="form-control" disabled
                    value="{{ is_null($order) ? '' : date('d-M-Y', strtotime($order->created_at)) }}">
            </div>
            @if (isset($order))
                <div class="mb-3">
                    <label for="" class="mb-2">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control num-only" disabled value="{{ $totalNetAmount }}" id="total-amount">
                </div>
            @else
                <div class="mb-3">
                    <label for="" class="mb-2">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control num-only" disabled value="" id="total-amount">
                </div>
            @endif

            <div class="mb-3">
                <label for="" class="mb-2">Paid Amount</label>
                <input type="number" name="paid_amount" class="form-control mf num-only" value="" id="paid-amount">
            </div>

            <div class="mb-3">
                <label for="" class="mb-2">Change Amount</label>
                <input type="number" name="change_amount" class="form-control mf num-only" value="" id="change-amount" readonly>
            </div>
        </form>

        <div class="checkout-footer">
            <div class="d-grid">
                <button id="checkout-btn" type="button" class="btn btn-lg btn-primary"><i class="ti ti-cash-register"></i>
                    Checkout</button>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#checkout-btn').on('click', function() {
            var totalAmount = {{ $totalNetAmount }};
            var paidAmount = parseFloat($('#paid-amount').val()) || 0;
            var changeAmount = paidAmount-totalAmount;
            $('#change-amount').val(changeAmount.toFixed(2));
            $('#checkout-form').submit();
        });

        $('#paid-amount').on('input', function() {
            var totalAmount = {{ $totalNetAmount }};
            var paidAmount = parseFloat($('#paid-amount').val()) || 0;
            var changeAmount = paidAmount-totalAmount;
            $('#change-amount').val(changeAmount.toFixed(2));
        });
    });
    </script> --}}

{{-- calculation working code --}}
{{-- <form action="" class="mt-4" id="checkout-form">
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

</script> --}}


{{-- first code --}}
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


