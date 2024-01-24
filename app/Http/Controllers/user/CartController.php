<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    public function CartPage() {

        $Cart_data = Cart::where('user_id', Auth::user()->id)->get();
        
        if($Cart_data->isEmpty()) {
            return redirect('/shop');
           
        } else {
            return view('web.Cart.index', compact('Cart_data'));
        }
    }

    public function AddtoCart(Request $req) {

        $Cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $req->input('product_id'))->first();
        if($Cart) {
            $Cart->delete();
            $icon = '<i  class="fa fa-shopping-cart"></i>';
            return response()->json(['data' => $icon]);

        } else {
            $data = new Cart();
            $data->user_id = Auth::user()->id;
            $data->product_id = $req->input('product_id');
            $data->quantity = 1;
            $data->product_price = $req->input('price');
            $data->save();
            $icon = '<i style="color:green" class="fa fa-shopping-cart"></i>';
            return response()->json(['data' => $icon]);
        }
    }

    public function Cart(Request $request) {
        $slug = $request->input('slug');
        $Product = Product::where('slug', $slug)->first();
        // return $Product;
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $Product->id)->first();
        if($cart) {
            $cart->update([
                'quantity' => $cart->quantity + 1,
            ]);
        } else {
            $data = new Cart();
            $data->user_id = Auth::user()->id;
            $data->product_id = $Product->id;
            $data->quantity = 1;
            $data->product_price = $Product->price;
            $data->save();
        }
        return redirect('/cart');
    }

    public function removeCartProduct(Request $req) {
        $ID = $req->input('id');
        // return $ID;
        $cart = Cart::find($ID);
        if($cart) {
            $cart->delete();
        }
        return response()->json(['success' => true]);
    }


    public function increaseProductQty(Request $req) {
        $data = Cart::find($req->input('id'));
        if($data) {
            $data->update([
                'quantity' => $data->quantity + 1,
            ]);
        }
        return response()->json(['success']);

    }

    public function decreaseProductQty(Request $req) {
        $data = Cart::find($req->input('id'));
        if($data->quantity >= 2) {
            $data->update([
                'quantity' => $data->quantity - 1,
            ]);
        } else {
            $data->delete();
        }
        return response()->json('success');


    }
}
