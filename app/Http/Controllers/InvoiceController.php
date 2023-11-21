<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $saleInfo = DB::table('sales')
        ->where('sales.id', $sale->id)
        ->leftjoin('customers', 'sales.customer_id', '=', 'customers.id')
        ->leftJoin('users', 'sales.seller_id', '=', 'users.id')
        ->leftJoin('accounts', 'sales.aid', '=', 'accounts.id')
        ->select(
            'sales.*',
            'customers.name',
            'customers.phone',
            'customers.email',
            'customers.address',
            'users.name as sname',
            'accounts.acc_name')
        ->first();
        $orders = DB::table('orders')
        ->where('sale_id', $sale->id)
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->select('orders.*', 'products.name', 'products.model')
        ->get();

        return view('invoice.invoice', compact('saleInfo', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
