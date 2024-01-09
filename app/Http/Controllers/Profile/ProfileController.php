<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\DesignerDetails;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //:::::::::::::: Designer Profile Function :::::::::::::::::::::::://
    public function updateProfile(Request $req)
    {
        $image = UserImage::where('user_id', Auth::user()->id)->first();
        $details = DesignerDetails::where('designer_id', Auth::user()->id)->first();
        if ($image) {
            if ($req->hasFile('profile_image')) {
                $p_image = $req->file('profile_image');
                $extension = $p_image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $p_image->move('images', $filename);
                $profile_image = $filename;
                $image->update(['profile_image' => $profile_image]);
            }

        } else {
            if ($req->hasFile('profile_image')) {
                $p_image = $req->file('profile_image');
                $extension = $p_image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $p_image->move('images', $filename);
                $profile_image = $filename;
            }

            $user_image = new UserImage();
            $user_image->user_id = Auth::user()->id;
            $user_image->profile_image = $profile_image;
            $user_image->save();
        }
        if ($details) {
            $details->update([
                'web_url' => $req->web_url,
                'street' => $req->street,
                'city' => $req->city,
                'state' => $req->state,
                'zip' => $req->zip,
                'country' => $req->country,
            ]);
        } else {
            $data = new DesignerDetails();
            $data->designer_id = Auth::user()->id;
            $data->web_url = $req->web_url;
            $data->street = $req->street;
            $data->city = $req->city;
            $data->state = $req->state;
            $data->Zip = $req->zip;
            $data->country = $req->country;
            $data->save();
        }
        $user = User::find(Auth::user()->id);
        if (!$req->name === null) {
            $user->update([
                'name' => $req->name,
                'email' => $req->email,
                'number' => $req->phone_number,
            ]);
        }
        return redirect()->back()->with('success', 'profile updated');
    }

    // ::::::::::::::::: user profile :::::::::::::::::::://
    public function userProfile()
    {
        return view('web.user_profile.user_profile');
    }

    //:::::::::::::: Admin Profile :::::::::::::::::::://
    public function adminProfile()
    {

        return view('Admin.profile.index');
    }

    public function designerProfile()
    {
        return view('designer.profile.Designer_profile');
    }

    //:: Update Profile :://
    public function UpdatePassword()
    {
        return view('web.user_profile.update_password');
    }

    public function ChangePassword()
    {
        return view('web.user_profile.update_password');
    }

    public function UpdatePasswordProcess(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => $request->new_password,
            ]);
            return redirect()->back()->with('success', 'password updated successfully');
        } else {
            return redirect()->back()->with('error', 'your current password is incorrect');
        }
    }

}
