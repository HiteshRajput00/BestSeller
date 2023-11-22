<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    Public function adminDashboard(){
        return view('Admin.dashboard.index');
    }

    public function adminProfile(){
        $image = UserImage::where('user_id',Auth::user()->id)->first();
        return view('Admin.profile.index',compact('image'));
    }

    public function userlist(){
        $user_list = User::where('role','=','user')->get();
        return view('Admin.user_list.index',compact('user_list'));
    }
}
