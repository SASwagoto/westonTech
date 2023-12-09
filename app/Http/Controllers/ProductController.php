<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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
        $products = Product::all();
        return view("products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::active()->get();
        return view('products.add', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'barcode' => 'required|string|unique:products',
            'specification' => 'nullable|string',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'model' => 'nullable|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'supplier_id' => 'nullable',
            'stocks' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $slug = Str::slug($request->name.'-'.now());
        $product = Product::create([
            'barcode' => $request->barcode,
            'name'=> $request->name,
            'slug'=> $slug,
            'supplier_id'=> $request->supplier_id,
            'stocks'=> $request->stocks,
            'model'=> $request->model,
            'specification'=> $request->specification,
            'purchase_price'=> $request->purchase_price,
        ]);
        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/products'), $imageName);

            $product->product_img = $imageName;
            $product->save();
        }
        if($request->giftable == 1)
        {
            $product->isGiftable = 1;
            $product->save();
        }

        Alert::success($product->name, 'Added Successfully');
        return redirect()->route('product.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::active()->get();
        $item = $product;
        return view('products.edit', compact('item', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Update the product with the new data
        $product->update([
            'name' => $request->name,
            'barcode' => $request->barcode,
            'specification' => $request->specification,
            'model' => $request->model,
            'purchase_price' => $request->purchase_price,
            'supplier_id' => $request->supplier_id,
            'stocks' => $request->stocks,
            'isGiftable' => $request->has('giftable') ? 1 : 0,
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('product_img')) {
            // Delete the old image file if it exists
            if ($product->product_img) {
                Storage::delete('storage/products/' . $product->product_img);
            }

            // Store the new image file
            $imagePath = $request->file('product_img')->store('storage/products');
            $product->update(['product_img' => basename($imagePath)]);
        }

        Alert::success('Updated', 'Product Details Updated');
        return redirect()->route('product.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Alert::success('Deleted','Item Deleted Successfully!');
        return redirect()->back();
    }

    // public function stock_add(Product $product)
    // {
    //     return view('products.stock', compact('product'));
    // }

    // public function stock_list(Product $product)
    // {
    //     $product = Product::find( $product->id );
    //     $stocks = Stock::where('product_id', $product->id )->get();
    //     return view('products.stocklist', compact('product', 'stocks'));
        
    // }

    // public function stock_store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'product_id' => 'required|exists:products,id',
    //         'barcode' => 'required|string',
    //         'color' => 'nullable|string',
    //         'unit' => 'nullable|string',
    //         'others' => 'nullable|string',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $product = Product::find($request->product_id);
    //     $stock = Stock::create($request->all());
    //     if($stock && $product){
    //         $product->stocks += 1;
    //         $product->save();
    //         //Storage::disk('public')->put($stock->barcode.'.png',base64_decode(DNS2D::getBarcodePNG("4", "PDF417")));
    //     }
    //     Alert::success($product->name,'Stock Updated');
    //     return redirect()->back();
    // }

    // public function stock_delete(Stock $stock)
    // {
    //     $product = Product::where('id', $stock->product_id )->firstOrFail();
    //     $product->stocks -= 1;
    //     $product->save();

    //     $stock->delete();
    //     Alert::success('Deleted','Item Deleted Successfully!');
    //     return redirect()->back();
    // }
}
