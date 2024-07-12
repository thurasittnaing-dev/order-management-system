@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')

@section('content')

<div class="row flex-column flex-lg-row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <span class="mr-3">
                    <img src="{{ asset('images/tableicon.png') }}" class="image-img" alt="">
                </span>
                <div class="mx-4">
                    <h3 class="card-title h2">{{ $availableTablesCount }}</h3>
                    <span class="text-primary d-flex align-items-center">
                        {{-- <i class="ti ti-armchair mr-2"></i> --}}
                        Available Tables
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <span class="mr-3">
                    <img src="{{ asset('images/tableicon.png') }}" class="image-img" alt="">
                </span>
                <div class="mx-4">
                    <h3 class="card-title h2">{{ $inUseTablesCount }}</h3>
                    <span class="text-primary d-flex align-items-center">
                        {{-- <i class="ti ti-armchair mr-2"></i> --}}
                        In Used Tables
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <span class="mr-3">
                    <img src="{{ asset('images/invoiceicon.png') }}" class="image-img" alt="">
                </span>
                <div class="mx-4">
                    <h3 class="card-title h2">{{ $totalInvoices }}</h3>
                    <span class="text-primary d-flex align-items-center">
                        {{-- <i class="ti ti-armchair mr-2"></i> --}}
                        Total Invoices
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <span class="mr-3">
                    <img src="{{ asset('images/incomeicon.png') }}" class="image-img" alt="">
                </span>
                <div class="mx-4">
                    <h3 class="card-title h2">{{ number_format($totalRevenue) }}</h3>
                    <span class="text-primary d-flex align-items-center">
                        {{-- <i class="ti ti-armchair mr-2"></i> --}}
                        Total Revenue
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daily Income</h4>
                <div id="daily-income-chart"></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daily Invoices</h4>
                <div id="daily-invoices-chart"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
    <style>
        #monthly-chart {
            width: 100%;
            height: 50vh;
            background-color: red;
        }
    </style>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dailyIncomeData = @json($dailyIncome);
        var dailyInvoicesData = @json($dailyInvoices);

        var incomeDates = dailyIncomeData.map(data => data.date);
        var incomeValues = dailyIncomeData.map(data => data.total_income);

        var invoiceDates = dailyInvoicesData.map(data => data.date);
        var invoiceValues = dailyInvoicesData.map(data => data.total_invoices);

        var incomeChartOptions = {
            series: [{
                name: 'Daily Income',
                data: incomeValues
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
                // formatter: function (val) {
                //     return "$" + val.toFixed(2);
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: incomeDates,
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
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            title: {
                text: 'Daily Income',
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
                name: 'Daily Invoices',
                data: invoiceValues
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
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: invoiceDates,
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
                    formatter: function (val) {
                        return val;
                    }
                }
            },
            title: {
                text: 'Daily Invoices',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var incomeChart = new ApexCharts(document.querySelector("#daily-income-chart"), incomeChartOptions);
        var invoicesChart = new ApexCharts(document.querySelector("#daily-invoices-chart"), invoicesChartOptions);

        incomeChart.render();
        invoicesChart.render();
    });
</script>
@endsection
