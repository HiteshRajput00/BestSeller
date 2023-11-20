<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){
        return view('web.shop.products');
    }

    public function singleProduct(){
        return view('web.shop.single-product');
    }
}
