<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $data = $this->invoiceService->index();
        return view('backend.invoice.index', $data);
    }

    // Display the specified invoice
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.invoice.show', compact('order'));
    }
}

