<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\designer_mail;
use App\Models\DesignerNotification;
use App\Models\disapprovedDesigner;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class AdminDesignerController extends Controller
{
    public function designerRequest(){
        $designer_list = User::where('role' , 'designer')->where('is_approved' , null)->where('is_disapproved',null)->get();
        if($designer_list->isEmpty()){
            Alert::warning('Sorry', 'You dont have any request ')->persistent(true, true);
            return redirect()->back();
        }
        return view('Admin.designer-list.requeslist',compact('designer_list'));
    }
//::::::::::::::: Disaprove Designer :::::::::::::::::::::::::::::::::://
    public function disapproveDesigner(Request $req){
        // dd($req->all());
        $user = User::find($req->designer_id);
        $user->update(['is_disapproved'=>true,'is_approved'=>false]);
        $maildata = [
            'name'=>$user->name,
            'title'=>'DisApprovel',
            'message' =>'Sorry! , you has been disapproved by admin to become a designer ',
        ];
        if($user){
            $data = new disapprovedDesigner();
            $data->designer_id = $req->designer_id;
            $data->reason = $req->disapproval_reason;
            $data->save();

            $designer_nf = new DesignerNotification();
            $designer_nf->designer_id = $user->id; 
            $designer_nf->title = $user->name;
            $designer_nf->message = "Sorry!, your are disapproved  by admin";
            $designer_nf->save();
        }
        Mail::to($user->email)->send(new designer_mail($maildata));
        return back()->with('msg','designer disapproved');
    }

//::::::::::::::::Approve Designer :::::::::::::::::::::::::::::::::::::::::::::::://
    public function approvedesigner($id){
        $user = User::find($id);
        $user->update(['is_approved'=>true, 'is_disapproved'=>false]);
        $maildata = [
            'name'=>$user->name,
            'title'=>'Approvel',
            'message' =>'you has been approved by admin to become a designer ,Now you can add your products and designes',
        ];
        if($user){
            $designer_nf = new DesignerNotification();
            $designer_nf->designer_id = $user->id; 
            $designer_nf->title = $user->name;
            $designer_nf->message = " you are approved as designer by admin";
            $designer_nf->save();
        }
        Mail::to($user->email)->send(new designer_mail($maildata));
        return back()->with('msg','designer approved');
    }

//::::::::::::: Approved or disaproved designer list ::::::::::::::::::::::::::::::::::::://
    public function approvedDesignerlist(){
        $designer_list = User::where('role','designer')->where('is_approved',1)->get();
        if($designer_list->isEmpty()){
            Alert::warning('Sorry', 'You dosen\'t approve any designer yet ')->persistent(true, true);
            return redirect()->back();
        }
        return view('Admin.designer-list.approved_designer',compact('designer_list'));
    }

    public function disapprovedDesignerlist(){
        $designer_list = User::where('role','designer')->where('is_disapproved',1)->get();
        if($designer_list->isEmpty()){
            Alert::warning('Sorry', 'You don\'t disapprove any designer yet  ')->persistent(true, true);
            return redirect()->back();
        }
        return view('Admin.designer-list.disapproved_designer',compact('designer_list'));
    }
}
