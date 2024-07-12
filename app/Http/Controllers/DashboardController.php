<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $totalRevenue = Order::sum('net_amount');
        $totalInvoices = Order::count();

        $availableTablesCount = OrderTables::where('in_used',0)->count();
        $inUseTablesCount = OrderTables::where('in_used',1)->count();

        // Fetch monthly income for the current year
        $monthlyIncome = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(net_amount) as total_income')
        )->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Fetch monthly total invoices for the current year
        $monthlyInvoices = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_invoices')
        )->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Initialize an array with all months set to 0
        $monthsOfYear = array_fill(1, 12, 0);
        $monthsOfYearInvoices = array_fill(1, 12, 0);

        // Populate the array with actual income data
        foreach ($monthlyIncome as $income) {
            $monthsOfYear[$income->month] = $income->total_income;
        }

        // Populate the array with actual invoices data
        foreach ($monthlyInvoices as $invoice) {
            $monthsOfYearInvoices[$invoice->month] = $invoice->total_invoices;
        }

        return view('backend.dashboard.main-dashboard', compact('totalRevenue','totalInvoices','availableTablesCount','inUseTablesCount','monthsOfYear','monthsOfYearInvoices'));
    }
}
