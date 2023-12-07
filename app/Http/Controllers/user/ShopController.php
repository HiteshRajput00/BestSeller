<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $media = Media::where('product_id', $product->id)->get();
        $review = ProductReview::where('product_id', $product->id)->avg('rating');
        return view('web.shop.single-product', compact('product', 'media', 'review'));
    }



    public function explorecategory($slug)
    {
        $cat = Categories::where('slug', $slug)->first();
        $products = Product::where('category_id', $cat->id)->paginate(9);
        return view('web.explore-category.index', compact('products', 'cat'));

    }
}
