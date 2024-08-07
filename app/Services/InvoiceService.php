<?php

namespace App\Services;

use App\Models\Order;

class InvoiceService
{
    // public function index()
    // {
    //     $query = Order::query()
    //         ->when(request('invoice_no'), fn ($query) =>  $query->where('invoice_no', 'LIKE', '%' . request('invoice_no') . '%'));

    //     $orders = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

    //     // Calculate net_amount for each order and the total net_amount
    //     $totalNetAmount = 0;
    //     foreach ($orders as $order) {
    //         $order->net_amount = $order->amount - $order->discount + $order->service_charges;
    //         $totalNetAmount += $order->net_amount;
    //     }

    //     return [
    //         'i' => getTableIndexer(5),
    //         'count' => $query->count(),
    //         'orders' => $orders,
    //         'total_net_amount' => $totalNetAmount,
    //     ];
    // }

    public function index()
    {
        $query = Order::query()
            ->when(request('invoice_no'), fn($query) => $query->where('invoice_no', 'LIKE', '%' . request('invoice_no') . '%'))
            ->when(request('datefilter'), function($query) {
                $dateRange = request('datefilter');
                $dates = explode("-", $dateRange);
                $startDateTime = date('Y-m-d 00:00:00', strtotime($dates[0]));
                $endDateTime = date('Y-m-d 23:59:59', strtotime($dates[1]));
                $query->whereBetween('updated_at', [$startDateTime, $endDateTime]);
            });;

        $totalNetAmount = $query->sum('net_amount');

        $totalCount = $query->count();

        $orders = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return [
            'i' => getTableIndexer(5),
            // 'count' => $query->count(),
            'count' => $totalCount,
            'orders' => $orders,
            'total_net_amount' => $totalNetAmount,
        ];
    }
}


