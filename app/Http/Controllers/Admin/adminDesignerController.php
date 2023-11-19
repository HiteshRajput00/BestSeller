<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class adminDesignerController extends Controller
{
    public function designerlist(){
        $designer_list = User::where('role' === 'designer' && 'is_approved' === 0)->get();
        return view('Admin.designer-list.requeslist',compact('designer_list'));
    }

    public function approvedesigner($id){
        $user = User::find($id);
        $user->update(['is_approved'=>true]);
    }
}
