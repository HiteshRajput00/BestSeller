<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    Public function adminDashboard(){
        return view('Admin.dashboard.index');
    }

    public function adminProfile(){
        return view('Admin.profile.index');
    }
}
