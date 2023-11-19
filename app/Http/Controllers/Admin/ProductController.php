<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productrequest(){
        $products = Product::where('is_approved','=',0)->where('disapproved','=',0)->get();
        return view('Admin.products.request',compact('products'));
    }

    public function approveProduct($id){
        $product = Product::find($id);
        $product->update(['is_approved'=>true,'disapproved'=>false]);
        return redirect('/product-request');
    }

    public function disapproveProduct($id){
        $product = Product::find($id);
        $product->update(['is_approved'=>false,'disapproved'=>true]);
        return redirect('/product-request');
    }

    public function productapproved(){
        return view();
    }
}
