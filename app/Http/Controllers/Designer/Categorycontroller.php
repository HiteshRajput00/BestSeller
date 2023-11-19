<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{
    public function categoryPage(){
        $parent_category = Categories::whereNull('parent_category_id')->get();
        return view('designer.Category.add_category',compact('parent_category'));
    }

    public function addcatProcess(Request $req){
        //  dd($req->all());
        $req->validate([
            'category_name'=>'required',
            'slug'=>'required|unique:categories',
            'cat_image'=>'required',
            
        ]);
        $data = new Categories();
        $data->name = $req->category_name;
        $data->slug = $req->slug;
        if($req->hasFile('cat_image')){
    
            $file=$req->file('cat_image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images',$filename);
            $image=$filename;

        }

        $data->image = $image;
        if($req->parent_category){
        $data->parent_category_id = $req->parent_category;
    }
    $data->save();
    return back()->with('msg','success');
    }

    public function categoryList(){
        $cat_list = Categories::all();
        return view('Admin.category.category_list',compact('cat_list'));
    }
}
