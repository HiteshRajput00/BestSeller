<?php

namespace App\Http\Controllers\notification;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\DesignerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //:::::::::::::: Admin notification function::::::::::::::::::::::::::::://
    public function adminNotifications()
    {
        $nf_data = AdminNotification::all();
        return view('Admin.notification.index', compact('nf_data'));
    }

    public function adminnfread()
    {
        $nf_data = AdminNotification::where('status', 1)->get();
        foreach ($nf_data as $data) {
            $data->update(['status' => false]);
        }
        return back();
    }

    public function clearAdminnotification()
    {
        AdminNotification::truncate();
        return back()->with('msg', 'success');
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::::: designer notification function ::::::::::::::::::::::://
    public function designerNotifications()
    {
        $nf_data = DesignerNotification::where('designer_id', '=', Auth::user()->id)->get();
        return view('designer.designer-notification.index', compact('nf_data'));
    }

    public function designernfread()
    {
        $nf_data = DesignerNotification::where('status', 1)->get();
        foreach ($nf_data as $data) {
            $data->update(['status' => false]);
        }
        return back();
    }

    public function cleardesignernotification()
    {
        DesignerNotification::truncate();
        return back()->with('msg', 'success');
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
}
