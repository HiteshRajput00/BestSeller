<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class registerloginController extends Controller
{
    Public function registerpage(){
        return view('forms.register');
    }

    public function regprocess(Request $req){
       $req->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required',
        'number'=>'required',
        'role'=>'required'
       ]);

       $data = new User();
       $data->name = $req->name;
       $data->email = $req->email;
       $data->number = $req->number;
       $data->password = $req->password;
       if($req->role === 'user'){
        $data->role = 1;
        $data->is_approved = true;
       }else if($req->role === 'designer'){
        $data->role = 2;
        $data->is_approved = false;
       }
       $data->save();
       return redirect('/')->with('msg','success');
    }

    public function loginpage(){
        return view('forms.login');
    }

    public function loginprocess(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credent = $req->only('email', 'password');
        if (Auth::attempt($credent)) {
            if(Auth::user()->role === 'admin'){
             return redirect('/admin-dashboard');
            }elseif(Auth::user()->role === 'designer'){
                return redirect('/designer-dashboard');
            }else{
                return redirect('/');
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
