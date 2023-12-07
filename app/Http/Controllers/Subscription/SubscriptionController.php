<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

class SubscriptionController extends Controller
{

    public function SubscriptionPage()
    {
        return view('web.subscription.index');
    }
    public function subscriptionProcess(Request $req)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $product = Product::create([
                'name' => 'monthly',
                'type' => 'good',
            ]);
    
            return $this->createPrice($product->id);
        } catch (ApiErrorException $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function createPrice($productId)
    {
        try {
            $price = Price::create([
                'product' => $productId,
                'unit_amount' => 1000,
                'currency' => 'inr',
            ]);

            return $this->createPaymentIntent($price->id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function createPaymentIntent($priceId)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 1000, 
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'setup_future_usage' => 'off_session',
                'confirm' => true,
                'payment_method' => 'pm_card_visa', 
                'description' => 'Test Payment',
                'statement_descriptor' => 'Test Payment',
                'metadata' => ['order_id' => '123'],
            ]);

            return response()->json(['success' => true, 'clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
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
