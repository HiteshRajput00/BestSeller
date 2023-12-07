<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $data = $request->input('search');
        $products = Product::search($data)->get();
        if ($products->isEmpty()) {
            return back()->with('msg', 'no result found');
        } else {
            return view('web.explore-category.search', compact('products'));
        }
    }
}
