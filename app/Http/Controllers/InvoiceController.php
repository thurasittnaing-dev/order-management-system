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

    public function show($id)
    {
        $order = Order::with(['orderRecipes.recipe'])
            ->where('id', $id)
            ->first();

        return view('backend.invoice.show', compact('order'));
    }
}
