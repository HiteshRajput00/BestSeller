<?php

namespace App\Http\Controllers\registerlogin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'number' => 65474121,
                'password' => 1,

            ]);

            // Log in the new user
            Auth::login($newUser);
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
}
