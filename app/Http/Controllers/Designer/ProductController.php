<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;

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

    }
}
