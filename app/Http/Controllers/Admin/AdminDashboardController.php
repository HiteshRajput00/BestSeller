<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    Public function adminDashboard(){
        return view('Admin.dashboard.index');
    }

    public function adminProfile(){
        return view('Admin.profile.index');
    }

    public function userlist(){
        $user_list = User::where('role','=','user')->get();
        return view('Admin.user_list.index',compact('user_list'));
    }
}
