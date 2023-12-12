<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;

class ShopController extends Controller
{
    public function shop()
    {
        $products = product::paginate(10);
        return view('web.shop.products', compact('products'));
    }

    public function singleProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('web.shop.single-product', compact('product'));
    }



    public function explorecategory($slug)
    {
        $cat = Categories::where('slug', $slug)->first();
        $products = Product::where('categories_id', $cat->id)->paginate(9);
        return view('web.explore-category.index', compact('products', 'cat'));

    }
}
