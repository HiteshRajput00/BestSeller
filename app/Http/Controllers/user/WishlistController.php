<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $req)
    {

        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $req->input('product_id'))->first();
        if ($wishlist) {
            $wishlist->delete();
            $icon = "<i class='fa fa-heart'></i>";
            return response()->json(['data' => $icon]);
        } else {
            $data = new Wishlist();
            $data->user_id = Auth::user()->id;
            $data->product_id = $req->input('product_id');
            $data->save();
            $icon = '<i style="color:red" class="fa fa-heart"></i>';
            return response()->json(['data' => $icon]);
        }
    }

    public function favourite(){
        $favourite = Wishlist::where('user_id','=',Auth::user()->id)->paginate(10);
        return view('web.favourites.index',compact('favourite'));
    }

}
