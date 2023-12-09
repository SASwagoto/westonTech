<?php

namespace App\Http\Controllers;

use App\Models\Account;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("role:Super-Admin");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.acc', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('accounts.accadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            DB::table('accounts')->insert([
            'acc_name' => $request->acc_name,
            'acc_type'=> $request->acc_type,
            'bank_name'=> $request->bank_name,
            'acc_no'=> $request->acc_no,
            'balance'=> $request->init_balance,
            'created_at'=> now(),
            'updated_at'=> now()
            ]);
        Alert::success($request->acc_name, 'Added Successfully!');
        return redirect()->route('acc.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    public function statments($id)
    {
        $acc = DB::table('accounts')->where('id', $id)->first();
        $stats = DB::table('statements')
        ->where('statements.aid', $id)
        ->leftJoin('incomes', 'statements.income_id', '=', 'incomes.id')
        ->leftJoin('expenses', 'statements.expense_id', '=', 'expenses.id')
        ->select('statements.*', 'incomes.source', 'incomes.description as idesc', 'expenses.payee', 'expenses.description as edesc')
        ->get();

        return view('accounts.statement', compact('stats', 'acc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $account = Account::find($id);
        $account->delete();

        Alert::success('Deleted','Accounts Deleted Successfully!');
        return redirect()->route('acc.index');
    }

    public function incomes()
    {
        $accounts = Account::all();
        $incomes = DB::table('incomes')
        ->leftJoin('accounts', 'incomes.aid', '=', 'accounts.id')
        ->select('incomes.*', 'accounts.acc_name')
        ->get();
        return view('accounts.income', compact('accounts', 'incomes'));
    }

    public function addIncome(Request $request)
    {
        //return $request;
        $income = DB::table('incomes')->insertGetId([
            'aid'=> $request->aid,
            'source'=> $request->source,
            'amount'=> $request->amount,
            'date'=> date('Y-m-d', strtotime($request->date)),
            'description'=> $request->description,
            'created_by'=> Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        DB::table('accounts')->where('id', $request->aid)->increment('balance', $request->amount);
        $trans_id = Str::random(6);
        DB::table('statements')->insert([
            'aid'=> $request->aid,
            'trans_id'=> $trans_id,
            'income_id'=> $income,
            'date'=> now(),
            'notes' => 'Income',
            'amount' => $request->amount,
            'current_balance' => DB::table('accounts')->where('id', $request->aid)->first()->balance,
            'created_by' => Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        Alert::success('Income','Added Successfully');
        return redirect()->back();
    }

    public function editIncome(Request $request)
    {
        $income = DB::table('incomes')->where('id', $request->income_id)->first();
        $prevAmount = $income->amount;

        DB::table('incomes')->where('id', $request->income_id)->update([
            'aid'=> $request->aid,
            'source'=> $request->source,
            'amount'=> $request->amount,
            'date'=> date('Y-m-d', strtotime($request->date)),
            'description'=> $request->description,
            'created_by'=> Auth::user()->id,
            'updated_at'=> now()
        ]);
        DB::table('accounts')->where('id', $income->aid)->decrement('balance', $prevAmount);
        DB::table('accounts')->where('id', $request->aid)->increment('balance', $request->amount);
        DB::table('statements')->where('income_id', $income->id)->update([
            'aid'=> $request->aid,
            'date'=> now(),
            'notes' => 'Income',
            'amount' => $request->amount,
            'current_balance' => DB::table('accounts')->where('id', $request->aid)->first()->balance,
            'created_by' => Auth::user()->id,
            'updated_at'=> now()
        ]);
        Alert::success('Income','Updated Successfully');
        return redirect()->back();
    }

    public function deleteIncome(Request $request)
    {
        $income = DB::table('incomes')->where('id', $request->id)->first();
        DB::table('accounts')->where('id', $income->aid)->decrement('balance', $income->amount);
        DB::table('statements')->where('income_id', $income->id)->delete();

        DB::table('incomes')->where('id', $request->id)->delete();

        Alert::success('Deleted','Deleted Successfully');
        return redirect()->back();
    }
    public function expenses()
    {
        $accounts = Account::all();
        $expenses = DB::table('expenses')
        ->leftJoin('accounts', 'expenses.aid', '=', 'accounts.id')
        ->select('expenses.*', 'accounts.acc_name')
        ->get();
        return view('accounts.expense', compact('accounts', 'expenses'));
    }

    public function addExpense(Request $request)
    {
        //return $request;
        $expense = DB::table('expenses')->insertGetId([
            'aid'=> $request->aid,
            'payee'=> $request->payee,
            'amount'=> $request->amount,
            'date'=> date('Y-m-d', strtotime($request->date)),
            'description'=> $request->description,
            'created_by'=> Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        DB::table('accounts')->where('id', $request->aid)->decrement('balance', $request->amount);
        $trans_id = Str::random(6);
        DB::table('statements')->insert([
            'aid'=> $request->aid,
            'trans_id'=> $trans_id,
            'expense_id'=> $expense,
            'date'=> now(),
            'notes' => 'Income',
            'amount' => $request->amount,
            'current_balance' => DB::table('accounts')->where('id', $request->aid)->first()->balance,
            'created_by' => Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        Alert::success('Expense','Added Successfully');
        return redirect()->back();
    }
}
