<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class userDashboardController extends Controller
{
    Public function index(){
        $categories = Categories::whereNull('parent_category_id')->get();
        return view('web.dashboard.index' ,compact('categories'));
    }

    public function contactUs(){
        return view('web.site-pages.contact_us');
    }

    public function abouttUs(){
        return view('web.site-pages.about_us');
    }
}
