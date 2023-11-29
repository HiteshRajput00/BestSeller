<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\DesignerDetails;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerDashboardController extends Controller
{
    public function designerDashboard()
    {
        return view('designer.dashboard.index');
    }

    public function designerProfile()
    {
        $image = UserImage::where('user_id', Auth::user()->id)->first();
        $details = DesignerDetails::where('designer_id', Auth::user()->id)->first();
        return view('designer.profile.Designer_profile', compact('image', 'details'));
    }


}
