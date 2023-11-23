<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productPage(){
        $category = Categories::all();
        return view('designer.product.add_product',compact('category'));
    }

    public function addproductProcess(Request $req){
      
        $req->validate([
            'product_name'=>'required',
            'image'=>'required',
            'slug'=>'required|unique:products,slug',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
        ]);

        $data = new Product();
        $data->designer_id = Auth::user()->id;
        $data->name = $req->product_name;
        $data->slug = $req->slug;
        $data->category_id = $req->category;
        $data->price = $req->price;
        $data->stock = $req->stock;
        $data->description = $req->description;
        $data->save();
        
        if($images = $req->File('image')){
            foreach($images as $image){      // storing array of images
            $media = new Media();
            $file=$image;
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images',$filename);
            $image=$filename;
            $media->product_id = $data->id;
            $media->image = $image;
            $media->save();
        }
        }
      
        $nf = new AdminNotification();      // notification to admin 
        $nf->title = Auth::user()->name;
        $nf->message = "has added a new product";
        $nf->save();
      

        return back()->with('success','product added successfully');
    }

    

    public function approvedproduct(){
    
        $products = Product::where('designer_id',Auth::user()->id)->where('is_approved',true)->get();
        if($products->isEmpty()){
            Alert::warning('Sorry', 'You dont have any approved product yet...... ')->persistent(true, true);   // sweet alert
            return redirect()->back();
        }
        return view('designer.product.Approved_product',compact('products'));
    }
    public function disapprovedproduct(){
       
        $products = Product::where('designer_id',Auth::user()->id)->where('is_disapproved',true)->get();
        if($products->isEmpty()){
            Alert::success('well done', 'You dont have any disapproved product yet')->persistent(true, true);   // sweet alert
            return redirect()->back();
        }
        return view('designer.product.Approved_product',compact('products'));
    }

    public function pendingproduct(){
        $products = Product::where('designer_id',Auth::user()->id)->where('is_approved',false)->where('is_disapproved',false)->get();
        if($products->isEmpty()){
            Alert::success( 'You dont have any pending product request ')->persistent(true, true);    // sweet alert
            return redirect()->back();
        }
        return view('designer.product.Approved_product',compact('products'));
    }

    //::::::::::::::::::::: Edit product ::::::::::::::::::::::::::::::::::::::::::::::::::;//
    public function EditProductPage($id){
        $product = Product::find($id);
        $media = Media::where('product_id',$id)->get();
        $categories = Categories::all();
        return view('designer.product.update_product',compact('product','categories','media'));
    }

    public function updateProductProcess(Request $req){
        $data = Product::find($req->product_id);
        if($req->hasFile('image')){
            $media = Media::find($req->image_id);
            $image = $req->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $image->move('images',$filename);
            $media_image=$filename;
            $media->update(['image'=>$media_image]);
        }

        if($data){
            $data->update([
                'name'=>$req->product_name,
                'slug'=>$req->slug,
                'price'=>$req->price,
                'stock'=>$req->stock,
            ]);
        }
        return redirect()->back();

    }

}
