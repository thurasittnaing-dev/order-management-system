<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        // dd($request->all());
        $totalRevenue = Order::sum('net_amount');
        $totalInvoices = Order::count();

        $availableTablesCount = OrderTables::where('in_used', 0)->count();
        $inUseTablesCount = OrderTables::where('in_used', 1)->count();

        $selectedYear = $request->input('income_year', date('Y'));
        $selectedInvoiceYear = $request->input('invoice_year', date('Y'));

        $monthsOfYear = $this->getMonthlyIncomeData($selectedYear);
        $monthsOfYearInvoices = $this->getMonthlyInvoicesData($selectedInvoiceYear);


        return view('backend.dashboard.main-dashboard', compact('totalRevenue', 'totalInvoices', 'availableTablesCount', 'inUseTablesCount', 'monthsOfYear', 'monthsOfYearInvoices', 'selectedYear', 'selectedInvoiceYear'));
    }

    private function getMonthlyIncomeData($year)
    {
        // Fetch monthly income for the selected year
        $monthlyIncome = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(net_amount) as total_income')
        )->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize an array with all months set to 0
        $monthsOfYear = array_fill(0, 12, 0);

        // Populate the array with actual income data
        foreach ($monthlyIncome as $income) {
            $monthsOfYear[$income->month - 1] = $income->total_income;
        }

        return $monthsOfYear;
    }

    private function getMonthlyInvoicesData($year)
    {
        // // Fetch monthly total invoices for the selected year
        // $monthlyInvoices = Order::select(
        //     DB::raw('MONTH(created_at) as month'),
        //     DB::raw('COUNT(id) as total_invoices')
        // )->whereYear('created_at', $year)
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();

        // Fetch monthly total invoices for the selected year with status = 1
        $monthlyInvoices = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_invoices')
        )->whereYear('created_at', $year)
            ->where('status', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize an array with all months set to 0
        $monthsOfYearInvoices = array_fill(0, 12, 0);

        // Populate the array with actual invoices data
        foreach ($monthlyInvoices as $invoice) {
            $monthsOfYearInvoices[$invoice->month - 1] = $invoice->total_invoices;
        }

        return $monthsOfYearInvoices;
    }
}
