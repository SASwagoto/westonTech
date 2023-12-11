<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $customerId = '';
        if($request->customer_id == null){
            $customerId = DB::table('customers')->insertGetId([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
        }else{
            $customerId = $request->customer_id;
        }


        $totalPrice = array_sum(array_map(function($price, $quantity) {
            return $price * $quantity;
        }, $request->sale_price, $request->qty));
        //return $customerId .'-'. $totalPrice;

        $invoice = Str::random(6);
        $sale = DB::table('sales')->insertGetId([
            'invoice_id'=> $invoice,
            'customer_id'=> $customerId,
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
                'qty' => $request->input('qty')[$key],
                'sale_price' => $request->input('sale_price')[$key],
                'created_at'=> now(),
                'updated_at'=>now()
            ]);

            DB::table('products')->where('id', $pid)->decrement('stocks', $request->input('qty')[$key]);
        }

        session()->forget('cart');

        return redirect()->route('order.checkout', $sale);
        
        
    }
}
