<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlans;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Product;
use Stripe\Customer;
use Stripe\Subscription as subscriptionsss;

class SubscriptionController extends Controller
{

    public function AddSubscription()
    {
        $sub_list = SubscriptionPlans::all();
        return view('Admin.subscription.index', compact('sub_list'));
    }

    public function AddSubscriptionProcess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subscription_plan' => 'required',
            'recurring_time' => 'required',
            'price' => 'required|numeric',
            'Discount' => 'required|numeric',
        ]);

        $data = new SubscriptionPlans();
        $data->sub_type = $request->subscription_plan;
        $data->recurring_time = $request->recurring_time;
        $data->sub_price = $request->price;
        $data->discount = $request->Discount;
        $data->save();
        return back()->with('success', 'subscription plan added successfully');
    }
    public function SubscriptionPage()
    {
        $sub_list = SubscriptionPlans::all();
        return view('web.subscription.index', compact('sub_list'));
    }
    public function subscriptionForm($id)
    {
        return view('web.subscription.subscription_form', compact('id'));
    }

    public function subscriptionProcess(Request $request)
    {
        // dd($request->all());
        $sub_plan = SubscriptionPlans::find($request->plan_id);

        $data = new Subscription();
        $data->user_id = Auth::user()->id;
        $data->plan_id = $sub_plan->id;

        // dd($sub_plan);
        Stripe::setApiKey('sk_test_51O7AYgSIRjlSt6h3PVFN151TaXK5vReLGHv0vJojhxicdRxGBhsUlfiFw8SPuSZFtYbL9rlD7Mjck7MiVNL6enw500X6FspOJ0');

        $existingCustomer = Customer::all(['email' => Auth::user()->email])->data;

        if (!empty($existingCustomer)) {
            // Customer already exists, return the Stripe customer ID
            $customerId = $existingCustomer[0]->id;

            $user = User::find(Auth::user()->id);
                $user->update([
                    'stripe_id' =>$customerId
                ]);
                $customer = Customer::retrieve($customerId);

                // Set the default payment method (replace 'pm_card_example' with the actual payment method ID)
                $customer->invoice_settings->default_payment_method = 'card';
                $customer->save();

                $customer = Customer::update($customerId, [
                    'invoice_settings' => [
                        'default_payment_method' => 'card',
                    ],
                ]);
        } else {
        $customer = Customer::create([
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'source' => $request->stripeToken,
                ]);
                $user = User::find(Auth::user()->id);
                $user->update([
                    'stripe_id' => $customer->id
                ]);
                $customerId = $customer->id;
            }
        $product = Product::create([
            'name' => $sub_plan->sub_type,
            'type' => 'service', // or 'good' depending on your use case
        ]);

        $price = Price::create([
            'product' => $product->id,
            'currency' => 'usd', // or your desired currency
            'unit_amount' => $sub_plan->sub_price * 100, // price in cents
            'recurring' => [
                'interval' => $sub_plan->recurring_time, // or 'year' for annual plans
            ],
        ]);
        // save data 


        // Create a subscription for the customer
        $subscription = subscriptionsss::create([
            'customer' => $customerId,
            'items' => [
                [
                    'price' => $price->id,
                ],
            ],
        ]);

        $data->billing_cycle = $price->recurring['interval'];
        $data->stripe_subscription_id = $subscription->id;
        $data->payment_method = "card";
        $data->payment_status = false;
        $data->amount = $price->unit_amount;
        $data->start_date = Carbon::now()->toDateString();
        if ($sub_plan->recurring_time === 'month') {
            $data->end_date = Carbon::now()->addDays(30)->toDateString();
        } else if ($sub_plan->recurring_time === 'year') {
            $data->end_date = Carbon::now()->addDays(365)->toDateString();
        }
        $data->auto_renewal = false;
        $data->save();

    }

    public function subscriptionSuccess()
    {
    }
}
