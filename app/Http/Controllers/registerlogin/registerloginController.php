<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Mail\notificationmail;
use App\Mail\Recoverpassword;
use App\Mail\userNotify_mail;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class registerloginController extends Controller
{
    public function registerpage()
    {
        return view('forms.Authentication.register');
    }

    public function loginpage()
    {
        return view('forms.Authentication.login');
    }

    //::::::::::::::::::: Register function ::::::::::::::::::::::://
    public function regprocess(Request $req)
    {
        if (Auth::user()) {
            $data = User::find(Auth::user()->id);
            if ($req->role === 'user') {
                $data->update([
                    'password' => $req->password,
                    'number' => $req->number,
                    'role' => $req->role,
                    'is_approved' => true
                ]);
            } else {
                $data->update([
                    'password' => $req->password,
                    'number' => $req->number,
                    'role' => $req->role,
                ]);
            }

        } else {
            $req->validate([      // validate data according to request

                'g-recaptcha-response' => 'required|captcha',   //  verify Captcha
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'number' => 'required|unique:users',
                'role' => 'required',

            ]);

            $data = new User();    // create  New User 
            $data->name = $req->name;
            $data->email = $req->email;
            $data->number = $req->number;
            $data->password = $req->password;


            if ($req->role === 'user') {       // role user
                $data->role = 'user';
                $data->is_approved = true;
                $data->is_disapproved = false;


            } else if ($req->role === 'designer') {      // role designer
                $data->role = 'designer';

            }

            $maildata = [                                //admin mail data variable
                'title' => 'New' . $req->role . 'Registered',
                'name' => $req->name,
                'email' => $req->email,
                'number' => $req->number,
            ];

            $data->save();     // save user data

            $admin_nf = new AdminNotification();    // notification to admin 
            $admin_nf->title = $req->name;
            $admin_nf->message = 'new' . $req->role . 'registered';
            $admin_nf->status = true;
            $admin_nf->save();     // save admin notification 


            $userdata = [           //user mail data variable
                'title' => 'sucessfully  Registered',
                'name' => $req->name,
                'email' => $req->email,
                'number' => $req->number,
                'message' => 'you have successfully registered to web....... Enjoy!',

            ];
            $admin = User::where('role', 'admin')->get('email');
            foreach ($admin as $admin_email) {
                Mail::to($admin_email)->send(new notificationmail($maildata));        // mail  to admin 
            }
            Mail::to($req->email)->send(new userNotify_mail($userdata));        // mail  to registered user
        }

        if ($data->role === 'designer') {       // redirect according to role 

            Auth::login($data);
            return redirect('/designer-dashboard');

        } else {
            Auth::login($data);
            return redirect('/')->with('msg', 'success');
        }

    }


    //::::::::::::::: login function :::::::::::::::::::::::::::::://
    public function loginprocess(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'g-recaptcha-response' => 'required|captcha',    // Verify Captcha
            'email' => 'required',
            'password' => 'required',

        ]);

        $credent = $req->only('email', 'password');
        $remember = $req->has('remember');

        // twilio API //
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_PHONE_NUMBER');

        if (Auth::attempt($credent, $remember)) {


            $client = new Client($sid, $token);
            $to = '+91' . Auth::user()->number;
            $message = $client->messages->create(
                $to,
                [
                    'from' => $from,
                    'body' => "successfully login",
                ]
            );

            if (Auth::user()->role === 'admin') {       // redirect according to role 

                return redirect('/admin-dashboard')->with('success', 'welcome hitesh');

            } elseif (Auth::user()->role === 'designer') {

                return redirect('/designer-dashboard');

            } else {

                return redirect('/');
            }
        }
        return back()->with('msg', 'please enter vaild details');
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //::::::::::::::::: logout function ::::::::::::::::::::::::::::::::://
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //:::::::::::::::::: Send link :::::::::::::::::::://
    public function SendLinkpage()
    {
        return view('forms.recover_password.send_recover_link');
    }

    public function SendLink(Request $req)
    {
        $req->validate(['email' => 'required']);
        $user = User::where('email', $req->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'email not found');
        } else {
            $token = str::random(60) . '|' . $req->email;

            $url = route('change_password_page', ['token' => $token]);
            Mail::to($req->email)->send(new Recoverpassword($url));
            return back();
        }
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

    //:::::::::::::::::::::::: Change Password Page ::::::::::::::::::::::::::::::://
    public function passwordPage($token)
    {
        $tokenParts = explode('|', $token);
        if (count($tokenParts) !== 2) {
            abort(400);
        }

        list($token, $email) = $tokenParts;

        return view('forms.recover_password.change_password', ['token' => $token, 'email' => $email]);
    }

    public function changeProcess(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'email' => 'required',
            'password' => 'required',
            'confirm-password' => 'required'
        ]);

        $user = User::where('email', $req->email)->first();
        if ($user) {
            $user->update(['password' => $req->password]);
            return redirect('/login')->with('success', 'password updated successfully');
        } else {
            return redirect()->back()->with('error', 'error occured');
        }

    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
}
