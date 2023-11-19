<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userDashboardController extends Controller
{
    Public function index(){
        return view('web.dashboard.index');
    }
}
