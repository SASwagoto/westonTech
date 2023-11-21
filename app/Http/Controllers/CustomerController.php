<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|unique:customers',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);
    
        // Check if the validation fails
        if ($validator->fails()) {
            Alert::error('Error', 'There was an error!');
            return redirect()->back();
        }
        //return $request;
        $customer = DB::table('customers')->insert([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
        Alert::success('Success', 'Customer Added Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function getCustomer(Request $request){
        $cus_id = $request->input("id");
        $customer = DB::table('customers')->where('id', $cus_id)->first();
        return view('order.getCustomer', compact('customer'));
    }
}
