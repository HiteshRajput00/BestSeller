<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignerDashboardController extends Controller
{
    Public function designerDashboard(){
        return view('designer.dashboard.index');
    }
}
