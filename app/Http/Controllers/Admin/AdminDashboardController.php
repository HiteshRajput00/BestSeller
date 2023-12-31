<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    // Dashboard 
    public function adminDashboard()
    {
        return view('Admin.dashboard.index');
    }



    // User list
    public function userlist()
    {
        $user_list = User::where('role', '=', 'user')->get();
        return view('Admin.user_list.index', compact('user_list'));
    }
}
