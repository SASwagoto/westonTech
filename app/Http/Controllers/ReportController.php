<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("role:Super-Admin");
    }

    public function saleReport()
    {
        $accounts = DB::table('accounts')->get();
        $today = now()->toDateString();
        $orders = DB::table('sales')
        ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
        ->select('sales.*', 'customers.name', 'customers.phone')
        ->whereDate('sales.date', $today)
        ->orderBy('date', 'desc')
        ->get();
        return view('report.sale', compact('orders', 'accounts'));
    }

    public function saleReportByDate(Request $request)
    {
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));

        $accounts = DB::table('accounts')->get();
        $today = now()->toDateString();
        $orders = DB::table('sales')
        ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
        ->select('sales.*', 'customers.name', 'customers.phone')
        ->whereBetween('sales.date', [$startDate, $endDate])
        ->orderBy('date', 'desc')
        ->get();
        return view('report.sale', compact('orders', 'accounts', 'startDate', 'endDate' ));
    }


    public function trashbox()
    {
        $employees = User::onlyTrashed()->get();
        return view('report.trash', compact('employees'));
    }
}
