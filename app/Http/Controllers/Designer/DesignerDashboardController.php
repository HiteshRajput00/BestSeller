<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;


class DesignerDashboardController extends Controller
{
    public function designerDashboard()
    {
        return view('designer.dashboard.index');
    }




}
