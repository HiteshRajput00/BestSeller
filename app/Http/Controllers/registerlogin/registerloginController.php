<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Mail\notificationmail;
use App\Mail\userNotify_mail;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class registerloginController extends Controller
{
    public function registerpage()
    {
        return view('forms.register');
    }

    public function loginpage()
    {
        return view('forms.login');
    }

    //::::::::::::::::::: Register function ::::::::::::::::::::::://
    public function regprocess(Request $req)
    {
        if (Auth::user()) {
            $data = User::find(Auth::user()->id);
            $data->update([
                'password'=>$req->password,
                'number'=>$req->number,
                'role'=>$req->role
            ]);

        } else {
            $req->validate([      // validate data according to request

                'g-recaptcha-response' => 'required|captcha',   //  verify Captcha
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'number' => 'required',
                'role' => 'required',

            ]);

            $data = new User();    // create  New User 
            $data->name = $req->name;
            $data->email = $req->email;
            $data->number = $req->number;
            $data->password = $req->password;

            $admin_nf = new AdminNotification();   // notification to admin 
            $admin_nf->title = $req->name;

            if ($req->role === 'user') {    // role user
                $data->role = 'user';
                $data->is_approved = true;
                $data->is_disapproved = false;

                $maildata = [                     //admin mail data variable
                    'title' => 'New User Registered',
                    'name' => $req->name,
                    'email' => $req->email,
                    'number' => $req->number,
                ];

                $admin_nf->message = "new user registered";

            } else if ($req->role === 'designer') {   // role designer
                $data->role = 'designer';

                $maildata = [                               //admin mail data variable
                    'title' => 'New Designer Registered',
                    'name' => $req->name,
                    'email' => $req->email,
                    'number' => $req->number,
                ];

                $admin_nf->message = "new designer registered";
            }
            $admin_nf->status = true;
            $admin_nf->save();    // save notification 

            $data->save(); // save user data



            $userdata = [      //user mail data 
                'title' => 'sucessfully  Registered',
                'name' => $req->name,
                'email' => $req->email,
                'number' => $req->number,
                'message' => 'you have successfully registered to web....... Enjoy!',

            ];
            $admin = User::where('role', 'admin')->get('email');
            foreach ($admin as $admin_email) {
                Mail::to($admin_email)->send(new notificationmail($maildata));   // mail  to admin 
            }
            Mail::to($req->email)->send(new userNotify_mail($userdata));    // mail  to registered user
        }

            if ($data->role === 'designer') {

                Auth::login($data);
                return redirect('/designer-dashboard');  // redirect to designer dashboard

            } else {

                Auth::login($data);
                return redirect('/')->with('msg', 'success');  // redirect to user dashboard
            }
        
    }


    // ::::::::::::::: login function :::::::::::::::::::::::::::::://
    public function loginprocess(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'g-recaptcha-response' => 'required|captcha',   // Verify Captcha
            'email' => 'required',
            'password' => 'required',

        ]);

        $credent = $req->only('email', 'password');
        $remember = $req->has('remember');

        if (Auth::attempt($credent, $remember)) {
            if (Auth::user()->role === 'admin') {     //check role 

                return redirect('/admin-dashboard')->with('success', 'welcome hitesh');  // admin Dashboard

            } elseif (Auth::user()->role === 'designer') {

                return redirect('/designer-dashboard');   // designer Dashboard

            } else {

                return redirect('/');   // User Dashboard
            }
        }
        return back()->with('msg', 'please enter vaild details');  // if worng info entered
    }

    public function logout()
    {
        Auth::logout();            // logout user
        return redirect('/');
    }
}
