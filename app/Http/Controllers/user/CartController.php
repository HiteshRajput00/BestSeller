<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function CartPage()
    {
        return view('web.Cart.index');
    }

    public function AddtoCart(Request $req)
    {

        $Cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $req->input('product_id'))->first();
        if ($Cart) {
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

    public function Cart($slug)
    {
        $Product = Product::where('slug', $slug)->first();
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $Product->id)->first();
    }
}
