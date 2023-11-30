<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function subscriptionProcess(Request $req)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' =>
                    [
                        'price_data' => [
                            'currency' => 'inr',
                            'unit_amount' => 31000, 
                        ],
                    ],
                'success_url' => url('/subscription-success'),
                'cancel_url' => url('/subscription-fail'),
            ]);

            return response()->json(['id' => $session->id]);
        } catch (ApiErrorException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function subscriptionSuccess(Request $req)
    {
        dd($req->all());
        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->recuring_time = "yearly";
        $data->discount_percentage = 20;

    }

    public function subscriptionFail()
    {

    }
}
