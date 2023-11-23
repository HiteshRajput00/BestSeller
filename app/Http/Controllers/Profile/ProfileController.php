<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\DesignerDetails;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateProfile(Request $req){
        $image = UserImage::where('user_id',Auth::user()->id)->first();
        $details = DesignerDetails::where('designer_id',Auth::user()->id)->first();
        if($image){
            if($req->hasFile('profile_image')){
                $p_image = $req->file('profile_image');
                $extension=$p_image->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $p_image->move('images',$filename);
                $profile_image=$filename;
                $image->update(['profile_image'=>$profile_image]);
            }
            
        }else{
            if($req->hasFile('profile_image')){
                $p_image = $req->file('profile_image');
                $extension=$p_image->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $p_image->move('images',$filename);
                $profile_image=$filename;
            }
        
            $user_image = new UserImage();
            $user_image->user_id = Auth::user()->id;
            $user_image->profile_image = $profile_image;
            $user_image->save(); 
        }
        if($details){
           $details->update([
            'web_url'=>$req->web_url,
            'street'=>$req->street,
            'city'=>$req->city,
            'state'=>$req->state,
            'zip'=>$req->zip,
            'country'=>$req->country,
           ]);
        }else{
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
        if(!$req->name === null){
           $user->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'number'=>$req->phone_number,
            ]);
        }
       return redirect()->back()->with('success','profile updated');
    }

   //::::::::::::::::::::: Admin profile Update::::::::::::::::::::::::::::::://

   public function updateAdminProfile(Request $req){
    // dd($req->all());
        $image = UserImage::where('user_id',Auth::user()->id)->first();   // Update image
         if($image){
            if($req->hasFile('profile_image')){
                $p_image = $req->file('profile_image');
                $extension=$p_image->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $p_image->move('images',$filename);
                $profile_image=$filename;
                $image->update(['profile_image'=>$profile_image]);
            }
            
        }else{
            if($req->hasFile('profile_image')){
                $p_image = $req->file('profile_image');
                $extension=$p_image->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $p_image->move('images',$filename);
                $profile_image=$filename;
            }
        
            $user_image = new UserImage();
            $user_image->user_id = Auth::user()->id;
            $user_image->profile_image = $profile_image;
            $user_image->save(); 
        }

        $user = User::find(Auth::user()->id);   // update details
        if(!$req->name === null){
           $user->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'number'=>$req->phone_number,
            ]);
        }
       return redirect()->back()->with('success','profile updated');
   }
       

}
