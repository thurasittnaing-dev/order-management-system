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

        $dailyIncome = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(net_amount) as total_income')
        )->groupBy('date')->get();

        $dailyInvoices = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_invoices')
        )->groupBy('date')->get();

        return view('backend.dashboard.main-dashboard', compact('totalRevenue','totalInvoices','availableTablesCount','inUseTablesCount','dailyIncome','dailyInvoices'));
    }
}
