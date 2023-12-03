<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware('role:Super-Admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')
        ->whereNull('suppliers.deleted_at')
    ->leftJoin('products', 'suppliers.id', '=', 'products.supplier_id')
    ->select(
        'suppliers.*',
        DB::raw('SUM(products.purchase_price * products.stocks) as purchase')
    )
    ->groupBy('suppliers.id')
    ->get();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|regex:/^(\+88)?01[3-9]\d{8}$/|unique:suppliers,phone',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = Str::slug($request->name.'-'.now());
        $supplier =  Supplier::create([
            'name'=> $request->name,
            'slug'=> $slug,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/supplier'), $imageName);

            $supplier->image = $imageName;
            $supplier->save();
        } 

        Alert::success($supplier->name,'Added Successfully');
        return redirect()->route('sup.list');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $sup =  Supplier::find($request->id);
        $sup->delete();

        Alert::success('Deleted', 'Supplier Deleted Successfully!');
        return redirect()->back();
    }
}
