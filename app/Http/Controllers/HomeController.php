<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    
    public function index()
    {
        if(Auth::user()->hasRole('Super-Admin'))
        {
            $products = DB::table('products')->whereNull('deleted_at')->get();
            $sales = DB::table('sales')->get();

            $today = Carbon::today();
            $todayP = DB::table('products')
                ->whereNull('deleted_at')
                ->whereDate('created_at', $today)
                ->get();

            $todayS = DB::table('sales')
                ->whereDate('created_at', $today)
                ->get();
            return view("home", compact('products','sales','todayP', 'todayS'));
        }else{
            return redirect()->route('order.add');
        }
        
    }
}
