<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // Dashboard 
    public function adminDashboard()
    {
        return view('Admin.dashboard.index');
    }

    // Profile
    public function adminProfile()
    {
        
        return view('Admin.profile.index');
    }

    // User list
    public function userlist()
    {
        $user_list = User::where('role', '=', 'user')->get();
        return view('Admin.user_list.index', compact('user_list'));
    }
}
