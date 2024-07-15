@extends('layouts.modernize')

@section('title', 'Invoices')

@section('page', 'Invoices')

@section('content')

    <div class="container-fluid">
        @php
            $invoice_no = $_GET['invoice_no'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <input type="text" name="invoice_no" class="form-control" placeholder="Invoice No"
                                value="{{ $invoice_no }}">
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('invoices.index') }}" class="btn btn-danger">Clear</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search me-1"></i>Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Invoices</h3>
                        <p class="text-primary">Total Invoices: {{ $count }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-0"></div>
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead class="">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice No</th>
                            {{-- <th scope="col">Order Table ID</th> --}}
                            <th scope="col">Amount</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Service Charges</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Change</th>
                            <th scope="col">Net Amount</th>
                            <th scope="col">
                                <center>Action</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $key => $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                {{-- <td>{{ $order->order_table_id }}</td> --}}
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->service_charges }}</td>
                                <td>{{ $order->paid }}</td>
                                <td>{{ $order->change }}</td>
                                <td>{{ $order->net_amount }}</td>
                                <td align="center">
                                    <a href="{{ route('invoices.show', $order->id) }}" class="btn btn-secondary" target="_blank">View</a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no invoice yet!</td>
                            </tr>
                        @endforelse
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="6"></td>
                                <td><strong>Total Net Amount</strong></td>
                                <td>{{ number_format($total_net_amount) }}</td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div>
            <strong>Total Net Amount: </strong> {{ $total_net_amount }}
        </div> --}}
        <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
            {{ $orders->links() }}
        </div>
    </div>
    @endsection

    @section('css')

    @endsection

    @section('js')

    @endsection
