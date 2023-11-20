<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productPage(){
        $category = Categories::all();
        return view('designer.product.add_product',compact('category'));
    }

    public function addproductProcess(Request $req){
    
        $req->validate([
            'name'=>'required',
            'image'=>'required',
        ]);

        $data = new Product();
        $data->designer_id = Auth::user()->id;
        $data->name = $req->name;
        $data->slug = $req->slug;
        $data->category_id = $req->category;
        $data->price = $req->price;
        $data->stock = $req->stock;
        $data->save();
        if($req->hasFile('image')){
            $media = new Media();
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images',$filename);
            $image=$filename;
            $media->product_id = $data->id;
            $media->image = $image;
            $media->save();
        }
      if($data){
        $nf = new AdminNotification();
        $nf->title = Auth::user()->name;
        $nf->message = "has added a new product";
        $nf->save();
      }

        return back()->with('msg','product added successfully');

    }

    public function approvedproduct(){
        $products = Product::where('designer_id',Auth::user()->id)->where('is_approved',true)->get();
        return view('designer.product.Approved_product',compact('products'));
    }
    public function disapprovedproduct(){
        $products = Product::where('designer_id',Auth::user()->id)->where('is_disapproved',true)->get();
        return view('designer.product.Approved_product',compact('products'));
    }

    public function pendingproduct(){
        $products = Product::where('designer_id',Auth::user()->id)->where('is_approved',false)->where('is_disapproved',false)->get();
        return view('designer.product.Approved_product',compact('products'));
    }


}
