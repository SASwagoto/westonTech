<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        
    }

    public function create()
    {
        $customers = DB::table('customers')->orderBy('created_at', 'desc')->get();
        return view('order.create', compact('customers'));
    }
    
    public function store(Request $request)
    {
        //return $request;
        $totalPrice = array_sum($request->sale_price);

        $invoice = Str::random(6);
        $sale = DB::table('sales')->insertGetId([
            'invoice_id'=> $invoice,
            'customer_id'=> $request->customer_id,
            'total'=> $totalPrice,
            'date'=> now(),
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        foreach($request->product_id as $key => $pid){
            DB::table('orders')->insert([
                'product_id'=> $pid,
                'sale_id'=> $sale,
                'barcode' => $request->input('barcode')[$key],
                'sale_price' => $request->input('sale_price')[$key],
                'created_at'=> now(),
                'updated_at'=>now()
            ]);

            DB::table('stocks')->where('barcode', $request->input('barcode')[$key])->update([
                'isSold'=> true,
            ]);
            DB::table('products')->where('id', $pid)->decrement('stocks', 1);
        }

        session()->forget('cart');

        return redirect()->route('order.checkout', $sale);
        
        
    }
}
