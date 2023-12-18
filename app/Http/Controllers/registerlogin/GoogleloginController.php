<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Mail\userNotify_mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleloginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed.');
        }
        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log in the existing user
            Auth::login($existingUser);
        } else {
            // Create a new user
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'role' => 'user',
                'is_approved' => false,
                'is_disapproved' => false,
                'password' => 1,

            ]);

            $userdata = [      //user mail data 
                'title' => 'sucessfully  Registered',
                'name' => $newUser->name,
                'email' => $newUser->email,
                'number' => $newUser->number,
                'message' => 'you have successfully registered to web....... Enjoy!',

            ];
            Mail::to($newUser->email)->send(new userNotify_mail($userdata)); 
            // Log in the new user
            Auth::login($newUser);
            return $this->adddetails();

        }

        //:: Checking Role :://
        if (Auth::user()->role === 'admin') {

            return redirect('/admin-dashboard');

        } else if (Auth::user()->role === 'designer') {

            return redirect('/designer-dashboard');

        } else {
            return redirect('/');
        }
    }

    public function adddetails()
    {
        return view('forms.Authentication.add_details');
    }
}
