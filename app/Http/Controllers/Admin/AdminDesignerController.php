<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignerNotification;
use App\Models\disapprovedDesigner;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDesignerController extends Controller
{
    public function designerRequest(){
        $designer_list = User::where('role' , 'designer')->where('is_approved' , 0)->where('is_disapproved',0)->get();
        return view('Admin.designer-list.requeslist',compact('designer_list'));
    }
//::::::::::::::: Disaprove Designer :::::::::::::::::::::::::::::::::://
    public function disapproveDesigner(Request $req){
        // dd($req->all());
        $user = User::find($req->designer_id);
        $user->update(['is_disapproved'=>true]);
        if($user){
            $data = new disapprovedDesigner();
            $data->designer_id = $req->designer_id;
            $data->reason = $req->disapproval_reason;
            $data->save();

            $designer_nf = new DesignerNotification();
            $designer_nf->title = $user->name;
            $designer_nf->message = " your are approved as designer by admin";
            $designer_nf->save();
        }

        return back()->with('msg','designer disapproved');
    }

//::::::::::::::::Approve Designer :::::::::::::::::::::::::::::::::::::::::::::::://
    public function approvedesigner($id){
        $user = User::find($id);
        $user->update(['is_approved'=>true]);
        if($user){
            $designer_nf = new DesignerNotification();
            $designer_nf->title = $user->name;
            $designer_nf->message = "Sorry!, your are disapproved by admin";
            $designer_nf->save();
        }
        return back()->with('msg','designer approved');
    }

//::::::::::::: Approved or disaproved designer list ::::::::::::::::::::::::::::::::::::://
    public function approvedDesignerlist(){
        $designer_list = User::where('role','designer')->where('is_approved',1)->get();
        return view('Admin.designer-list.approved',compact('designer_list'));
    }

    public function disapprovedDesignerlist(){
        $designer_list = User::where('role','designer')->where('is_disapproved',1)->get();
        return view('Admin.designer-list.approved',compact('designer_list'));
    }
}
