<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = DB::table('accounts')->get();
        $orders = DB::table('sales')
        ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
        ->select('sales.*', 'customers.name', 'customers.phone')
        ->orderBy('date', 'desc')
        ->get();
        return view('order.orderList', compact('orders', 'accounts'));
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
        ->select(
            'sales.*',
            'customers.name',
            'customers.phone',
            'customers.email',
            'customers.address',)
        ->first();
        $orders = DB::table('orders')
        ->where('sale_id', $sale->id)
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->select('orders.*', 'products.name')
        ->get();

        $accs = DB::table('accounts')->get();
        $emps = User::role('employee')->get();
        return view('order.checkout', compact('saleInfo', 'orders', 'accs', 'emps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $saleInfo = Sale::find($request->sale_id);
        $saleInfo->aid = $request->aid;
        $saleInfo->payment = $request->payment;
        $saleInfo->due = $saleInfo->total - $request->payment;
        $saleInfo->seller_id = $request->seller_id;
        $saleInfo->save();

        DB::table('accounts')->where('id', $request->aid)->increment('balance', $request->payment);

        $income = DB::table('incomes')->insertGetId([
            'aid'=> $request->aid,
            'source'=> 'Sales',
            'amount'=> $request->payment,
            'date'=> date('Y-m-d'),
            'description'=> 'Product Sale Purpose',
            'created_by'=> Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        $trans_id = Str::random(6);
        DB::table('statements')->insert([
            'aid'=> $request->aid,
            'trans_id'=> $trans_id,
            'income_id'=> $income,
            'date'=> now(),
            'notes' => 'Sales',
            'amount' => $request->payment,
            'current_balance' => DB::table('accounts')->where('id', $request->aid)->first()->balance,
            'created_by' => Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        $url = route('sale.invoice', $saleInfo->id);
        return redirect()->route('order.list')->with('url', $url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function duePay(Request $request)
    {
        $sid = $request->id;
        DB::table('accounts')->where('id', $request->aid)->increment('balance', $request->payment);

        $income = DB::table('incomes')->insertGetId([
            'aid'=> $request->aid,
            'source'=> 'Sales',
            'amount'=> $request->payment,
            'date'=> date('Y-m-d'),
            'description'=> 'Due Bill Pay',
            'created_by'=> Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        $trans_id = Str::random(6);
        DB::table('statements')->insert([
            'aid'=> $request->aid,
            'trans_id'=> $trans_id,
            'income_id'=> $income,
            'date'=> now(),
            'notes' => 'Sales',
            'amount' => $request->payment,
            'current_balance' => DB::table('accounts')->where('id', $request->aid)->first()->balance,
            'created_by' => Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        DB::table('sales')->where('id', $sid)->update([
            'payment' => DB::raw("payment + $request->payment "),
                'due' => DB::raw("due - $request->payment "),
                'updated_at'=> now(),
        ]);

        $url = route('sale.invoice', $sid);
        return redirect()->route('order.list')->with('url', $url);
    }
}
