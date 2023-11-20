<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Mail\notificationmail;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class registerloginController extends Controller
{
    Public function registerpage(){
        return view('forms.register');
    }

//::::::::::::::::::: Register function ::::::::::::::::::::::://
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
       $admin_nf = new AdminNotification(); // notification to admin 
       $admin_nf->title = $req->name;
       if($req->role === 'user'){
        $data->role = 'user';
        $data->is_approved = true;
        
        $maildata = [
            'title' => 'New User Registered',
            'name' => $req->name,
            'email'=>$req->email,
            'number'=>$req->number,
        ];

        $admin_nf->message = "new user registered";
       }else if($req->role === 'designer'){
        $data->role = 'designer';
        $data->is_approved = false;
        $maildata = [                               // mail data variable
            'title' => 'New Designer Registered',
            'name' => $req->name,
            'email'=>$req->email,
            'number'=>$req->number,
        ];
        $admin_nf->message = "new user registered";
       }
       $admin_nf->status = true;
       $admin_nf->save();  // save notification 
       $data->save(); // save user data
    
    //::::::::::::::::: Mail to Admin :::::::::::::::::::::::::::::::::::::://
        Mail::to('hiteshrana3204@gmail.com')->send(new notificationmail($maildata));

    //::::::::::::::: Login User:::::::::::::::::::::::::://
        Auth::login($data);


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

        // login according to role 
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
        Auth::logout();            // logout user
        return redirect('/');
    }
}
