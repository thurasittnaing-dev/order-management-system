@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')

@section('content')

    <div class="row flex-column flex-lg-row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <span class="">
                        <img src="{{ asset('images/tableicon.png') }}" class="image-img" alt="">
                    </span>
                    <div class="mx-4">
                        <h3 class="card-title h2">{{ $availableTablesCount }}</h3>
                        <span class="text-primary d-flex align-items-center">
                            Available Tables
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <span class="">
                        <img src="{{ asset('images/tableicon.png') }}" class="image-img" alt="">
                    </span>
                    <div class="mx-4">
                        <h3 class="card-title h2">{{ $inUseTablesCount }}</h3>
                        <span class="text-primary d-flex align-items-center">
                            In Used Tables
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <span class="">
                        <img src="{{ asset('images/invoiceicon.png') }}" class="image-img" alt="">
                    </span>
                    <div class="mx-4">
                        <h3 class="card-title h2">{{ $totalInvoices }}</h3>
                        <span class="text-primary d-flex align-items-center">
                            Total Invoices
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <span class="">
                        <img src="{{ asset('images/incomeicon.png') }}" class="image-img" alt="">
                    </span>
                    <div class="mx-4">
                        <h3 class="card-title h2">{{ number_format($totalRevenue) }} MMK</h3>
                        <span class="text-primary d-flex align-items-center">
                            Total Revenue
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    {{-- <div class="mb-3 col-md-3">
    <form method="GET" action="{{ route('main-dashboard') }}" class="mb-3">
        <div class="form-group">
            <label for="year">Select Year:</label>
            <select class="form-control" id="year" name="year">
                @foreach (range(date('Y'), 2020, -1) as $year)
                    <option value="{{ $year }}" @if ($year == $selectedYear) selected @endif>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
</div> --}}
    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Monthly Income</h4>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('main-dashboard') }}"
                                class="mb-3 d-flex justify-content-end" id="form-1">
                                <input type="hidden" name="invoice_year" id="invoice-year-value"
                                    value="{{ request('invoice-year') }}">
                                <div class="form-group me-2">
                                    <label for="year" class="form-label">Select Year:</label>
                                    <select class="form-control" id="income-year" name="income_year">
                                        @foreach (range(date('Y'), 2020, -1) as $year)
                                            <option value="{{ $year }}"
                                                @if ($year == $selectedYear) selected @endif>{{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <button type="submit" class="btn btn-primary align-self-end">Apply</button> --}}
                            </form>
                        </div>
                    </div>
                    <div id="income-chart"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Monthly Invoices</h4>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('main-dashboard') }}"
                                class="mb-3 d-flex justify-content-end" id="form-2">
                                <input type="hidden" name="income_year" id="income-year-value"
                                    value="{{ request('income-year') }}">
                                <div class="form-group me-2">
                                    <label for="year" class="form-label">Select Year:</label>
                                    <select class="form-control" id="invoice-year" name="invoice_year">
                                        @foreach (range(date('Y'), 2020, -1) as $year)
                                            <option value="{{ $year }}"
                                                @if ($year == $selectedInvoiceYear) selected @endif>{{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <button type="submit" class="btn btn-primary align-self-end">Apply</button> --}}
                            </form>
                        </div>
                    </div>
                    <div id="invoices-chart"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')

@endsection

@section('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var monthsOfYear = @json(array_values($monthsOfYear));
            var monthsOfYearInvoices = @json(array_values($monthsOfYearInvoices));
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            function numberFormat(val) {
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            var incomeChartOptions = {
                series: [{
                    name: 'Income',
                    data: monthsOfYear,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return numberFormat(val);

                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: months,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return numberFormat(val) + ' MMK';
                        }
                    }
                },
                title: {
                    text: 'Monthly Income',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var invoicesChartOptions = {
                series: [{
                    name: 'Total Invoices',
                    data: monthsOfYearInvoices
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: months,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return val;
                        }
                    }
                },
                title: {
                    text: 'Monthly Total Invoices',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var incomeChart = new ApexCharts(document.querySelector("#income-chart"), incomeChartOptions);
            incomeChart.render();

            var invoicesChart = new ApexCharts(document.querySelector("#invoices-chart"), invoicesChartOptions);
            invoicesChart.render();
        });

        $('#income-year').on('change', function() {
            // console.log($('#invoice-year-value').val());
            $('#invoice-year-value').val($('#invoice-year').val());
            $('#form-1').submit();
        });

        $('#invoice-year').on('change', function() {
            $('#income-year-value').val($('#income-year').val());
            $('#form-2').submit();
        });
    </script>
@endsection
