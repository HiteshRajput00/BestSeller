<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignerNotification;
use App\Models\disapprovedProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function productrequest(){
        $products = Product::where('is_approved','=',0)->where('is_disapproved','=',0)->get();
        return view('Admin.products.request',compact('products'));
    }

//:::::::::::::: Approve Product ::::::::::::::::::::::::::::::::::::::::::::::://
    public function approveProduct($id){
        $product = Product::find($id);
        $product->update(['is_approved'=>true,'is_disapproved'=>false]);
        if($product){
         //::::::::::::: send notification to designer :::::::::::://
            $designer_nf = new DesignerNotification();
            $designer_nf->title = $product->name;
            $designer_nf->message = " your product has been approved by admin";
            $designer_nf->save();
        }
        return redirect('/product-request');
    }

//:::::::::::::: Disapprove Product ::::::::::::::::::::::::::::::::::::::::::::::::://
    public function disapproveProcess(Request $req ){
        $product = Product::find($req->product_id);
        $product->update(['is_approved'=>false,'is_disapproved'=>true]);
        if($product){
            //::::: Disapproval reason ::://
            $data = new disapprovedProduct();
            $data->designer_id = $product->designer_id;
            $data->product_id = $req->product_id;
            $data->reason = $req->disapproval_reason;
            $data->save();
            
            //::: Notification to designer ::::::::///
            $designer_nf = new DesignerNotification();
            $designer_nf->title = $product->name;
            $designer_nf->message = " your product has been disapproved by admin";
            $designer_nf->save();
        }
        return back()->with('msg','disapproved');
    }

//:::::::::::::::: approved or disapproved list :::::::::::::::::::::::::::::::::::::::::::://
    public function productapproved(){
        $products = Product::where('is_approved','=',1)->where('is_disapproved','=',0)->get();
        return view('Admin.products.approved_product',compact('products'));
    }

    public function productDisapproved(){
        $products = Product::where('is_approved','=',0)->where('is_disapproved','=',1)->get();
        return view('Admin.products.disapproved_product',compact('products'));
    }
}
