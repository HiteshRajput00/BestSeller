<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reviewController extends Controller
{
    public function AddReview(Request $req)
    {
        $req->validate([
            'rate' => 'required',
            'comment' => 'required'
        ]);
        $data = new ProductReview();
        $data->user_name = Auth::user()->name;
        $data->product_id = $req->product_id;
        $data->rating = $req->rate;
        $data->comment = $req->comment;
        $data->save();
        return back()->with('success', 'review added successfully');
    }
}
