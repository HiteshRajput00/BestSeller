<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    Public function CouponPage()
    {
        $coupons = Coupon::all(); 
        return view('Admin.coupons.index',compact('coupons'));
    }

    Public function SaveCoupon(Request $request)
    {
        $request->validate([
           'coupon_code' => 'required',
           'discount' => 'required',
           'available_for' => 'required',
           'expiry_date' => 'required|date',
        ]); 

        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount = $request->discount;
        $coupon->available_for = $request->available_for;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        return redirect()->back()->with('success','coupon added successfully');
    }
}
