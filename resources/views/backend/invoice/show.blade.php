{{-- @extends('layouts.modernize')

@section('title', 'Invoice Detail')

@section('page', 'Invoice Detail')

@section('content')

<div class="container">
    <h1>Invoice #{{ $order->invoice_no }}</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Invoice No</th>
            <th>Order Table ID</th>
            <th>Discount</th>
            <th>Amount</th>
            <th>Net Amount</th>
            <th>Paid</th>
            <th>Change</th>
        </tr>
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->invoice_no }}</td>
            <td>{{ $order->order_table_id }}</td>
            <td>{{ $order->discount }}</td>
            <td>{{ $order->amount }}</td>
            <td>{{ $order->net_amount }}</td>
            <td>{{ $order->paid }}</td>
            <td>{{ $order->change }}</td>
        </tr>
    </table>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to Invoices</a>
</div>

@endsection

@section('css')

@endsection

@section('js')

@endsection --}}

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Detail</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('modernize/assets/css/styles.css') }}">
</head>

<body>
    <div class="container">
        <div class="card mt-3">
            <h3>Invoice #{{ $order->invoice_no }}</h3>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Invoice No</th>
                    <th>Order Table ID</th>
                    <th>Discount</th>
                    <th>Amount</th>
                    <th>Net Amount</th>
                    <th>Paid</th>
                    <th>Change</th>
                </tr>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->invoice_no }}</td>
                    <td>{{ $order->order_table_id }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->net_amount }}</td>
                    <td>{{ $order->paid }}</td>
                    <td>{{ $order->change }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            {{-- <p>1234 Street Address, City, State, 56789</p>
            <p>Phone: (123) 456-7890 | Email: contact@restaurant.com</p> --}}
        </div>

        <div class="invoice-details">
            <div class="row mt-5">
                {{-- <div class="col-md-6">
                    <h5>Invoice To:</h5>
                    <p>
                        Customer Name<br>
                        5678 Another St<br>
                        City, State, 98765
                    </p>
                </div> --}}
                {{-- <div class="col-md-6 text-end"> --}}
                    <h5>Invoice Details:</h5>
                    <p>
                        Invoice #: {{ $order->invoice_no }}<br>
                        Date: {{ $order->created_at }}
                    </p>
                {{-- </div> --}}
            </div>
        </div>

        <table class="invoice-table table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice No</th>
                    <th>Order Table ID</th>
                    <th>Discount</th>
                    <th>Amount</th>
                    <th>Net Amount</th>
                    <th>Paid</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->invoice_no }}</td>
                    <td>{{ $order->order_table_id }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->net_amount }}</td>
                    <td>{{ $order->paid }}</td>
                    <td>{{ $order->change }}</td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-total">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>{{ $order->amount }}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>{{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <td>Net Amount</td>
                        <td>{{ $order->net_amount }}</td>
                    </tr>
                    <tr>
                        <td>Paid</td>
                        <td>{{ $order->paid }}</td>
                    </tr>
                    <tr>
                        <td>Change</td>
                        <td>{{ $order->change }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-footer text-center">
            <p>Thank you for dining with us!</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

