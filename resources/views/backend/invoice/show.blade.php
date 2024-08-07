<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Detail</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <style>
        .invoice {
            max-width: 21cm; /* A5 width in cm */
            min-height: 29.7cm; /* A5 height in cm */
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .invoice .invoice-header, .invoice .invoice-footer {
            background: #f5f5f5;
            padding: 15px;
        }
        .invoice .invoice-header h1 {
            margin: 0;
        }
        .invoice .invoice-details {
            margin-bottom: 30px;
        }
        .invoice .invoice-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice .invoice-table th, .invoice .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .invoice .invoice-table th {
            background: #f5f5f5;
        }
        .invoice .invoice-total {
            text-align: right;
        }
        .invoice .invoice-total td {
            padding: 10px;
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        @page {
            size: A5;
            margin: 0;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
            .invoice {
                border: none;
                box-shadow: none;
                margin: 0;
                padding: 0;
                width: auto;
                min-height: auto;
            }
            .invoice .invoice-header, .invoice .invoice-footer {
                padding: 0;
            }
            .invoice .invoice-total td {
                border-top: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header text-center">
            <h1>FOOD EXPRESS</h1>
            <img src="{{ asset('images/logo.png') }}" alt="Food Express Logo" style="max-width: 100px;">
        </div>

        <div class="invoice-details">
            <div class="row mt-5">
                    <h5>Invoice Details:</h5>
                    <p>
                        Invoice : {{ $order->invoice_no }}<br>
                        Date: {{ ($order->created_at)->format('Y-m-d') }}
                    </p>
            </div>
        </div>

        <table class="invoice-table table">
            <thead>
                <tr>
                    <th>Recipe Name</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderRecipes as $orderRecipe)
                    <tr>
                        <td>{{ $orderRecipe->recipe->name }}</td>
                        <td>{{ $orderRecipe->quantity }}</td>
                        <td>{{ number_format($orderRecipe->discount) }}</td>
                        <td>{{ number_format($orderRecipe->amount) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="fw-bold">
                <tr>
                    <td colspan="2"></td>
                    <td>Total Amount</td>
                    <td>{{ number_format($order->amount) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Service Charges</td>
                    <td>{{ number_format($order->service_charges) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Total Discount</td>
                    <td>{{ number_format($order->discount) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Net Amount</td>
                    <td>{{ number_format($order->net_amount) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="invoice-footer text-center">
            <p>Thank you for dining with us!</p>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{  asset('js/app.js') }}"></script>
    @section('css')

    @endsection

    @section('js')

    @endsection

</body>
</html>

