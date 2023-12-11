<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        
        $code = $request->input("barcode");
        $product = DB::table("products")->where("barcode", $code)
        ->where("stocks", ">", 0)
        ->select("barcode","id","name","model")
        ->first();

        if ($product) {
            $cart = session()->get('cart', []);
            $cart[] = $product;
    
            session()->put('cart', $cart);
    
            //return response()->json($cart);
            return view('order.cart-table', compact('cart'));
            
        }else{
            Alert::error('Error', 'Product Not Found');
            return response()->json(['error' => 'Your error message'], 400);
        }

      
    }

    public function removeCart($id)
    {
        $cartItems = session('cart', []);

        // Find the key of the item with the specified barcode
        $keyToRemove = array_search($id, array_column($cartItems, 'barcode'));

        // Remove the item from the cart if found
        if ($keyToRemove !== false) {
            unset($cartItems[$keyToRemove]);

            // Re-index the array to ensure consecutive numeric keys
            $cartItems = array_values($cartItems);

            // Update the cart session with the modified array
            session(['cart' => $cartItems]);
        }

        return redirect()->back();
    }

    public function removeCartAll()
    {
        session()->forget('cart');
        return redirect()->route('order.add');
    }


}
