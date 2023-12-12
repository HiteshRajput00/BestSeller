<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Price;

class SubscriptionController extends Controller
{

    public function AddSubscription()
    {
        return view('Admin.subscription.index');
    }

    public function AddSubscriptionProcess(Request $request)
    {
        dd($request->all());
    }
    public function SubscriptionPage()
    {
        return view('web.subscription.index');
    }
    public function subscriptionProcess(Request $req)
    {
        
    }

}
