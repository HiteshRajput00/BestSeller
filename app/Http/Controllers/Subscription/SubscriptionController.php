<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
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
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
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
    public function subscriptionForm(Request $request)
    {
        $id = $request->input('plan_id');
        return view('web.subscription.subscription_form', compact('id'));
    }

    public function subscriptionProcess(Request $request)
    {
        // stripe secret key 
        Stripe::setApiKey('sk_test_51OQ5lXSHuCTN4d6JX1bDDXk8y4bOe8XoHwO6kE7doayKqPmLiFX8tkKAu2QAx5YFxM53Vd7rhuaslc3zOuiSrdJe00rIQiC6mm');

        $paymentMethod = PaymentMethod::create([      // create payment method
            'type' => 'card',
            'card' => [
                'token' => $request->stripeToken,
            ],
        ]);

        $sub_plan = SubscriptionPlans::find($request->plan_id);
        // checking user subscription
        if (Auth::user()->subscription) {

            $subscription_id = Auth::user()->subscription->stripe_subscription_id;

        } else {

            $data = new Subscription();
            $data->user_id = Auth::user()->id;
            $data->plan_id = $sub_plan->id;

            if (!empty(Auth::user()->stripe_id)) {

                $customer_id = Auth::user()->stripe_id;

            } else {
                $customer = Customer::create([        // create customer if not created 
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'address' => [
                        'line1' => '510 Townsend St',
                        'postal_code' => '98140',
                        'city' => 'San Francisco',
                        'state' => 'CA',
                        'country' => 'US',
                    ],
                ]);

                $paymentMethod = PaymentMethod::retrieve($paymentMethod->id);
                $paymentMethod->attach(['customer' => $customer->id]);

                $customer = Customer::update($customer->id, [      // set payment method as default
                    'invoice_settings' => [
                        'default_payment_method' => $paymentMethod->id,
                    ],
                ]);

                $user = User::find(Auth::user()->id);

                $user->update([
                    'stripe_id' => $customer->id
                ]);

                $customer_id = $customer->id;
            }

            $product = Product::create([      // create product
                'name' => $sub_plan->sub_type,
                'type' => 'service',
            ]);

            $price = Price::create([         /// create price
                'product' => $product->id,
                'currency' => 'usd',
                'unit_amount' => $sub_plan->sub_price * 100,
                'recurring' => [
                    'interval' => $sub_plan->recurring_time,
                ],
            ]);

            // Create a subscription for the customer
            $subscription = subscriptionsss::create([
                'customer' => $customer_id,
                'items' => [
                    [
                        'price' => $price->id,
                    ],
                ],
            ]);

            $subscription_id = $subscription->id;

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
            $data->save();            /// save data in database
        }

        $subscription = subscriptionsss::retrieve($subscription_id);

        $latestInvoiceId = $subscription->latest_invoice;

        $latestInvoice = Invoice::retrieve($latestInvoiceId);

        if ($latestInvoice->status === 'open') {     // check invoice status 

            try {

                $paymentIntentID = $latestInvoice->payment_intent;

                $paymentIntent = PaymentIntent::retrieve($paymentIntentID);      // retrive payment

                if ($paymentIntent->status === 'requires_payment_method') {
                    
                    $paymentMethod_id = $paymentMethod->id;
                    $paymentIntent->payment_method = $paymentMethod_id;       // Replace with the actual Payment Method ID
                    $paymentIntent->save();

                    if ($paymentIntent->status === 'requires_action') {

                        $sub = Subscription::where('stripe_subscription_id', $subscription_id)->first();
                        $plan = SubscriptionPlans::find($sub->plan_id);
                        $sub->update([
                            'amount' => $paymentIntent->amount,
                            'payment_status' => true,
                            'auto_renewal' => true,
                            'is_active' => true,
                        ]);

                        $admin_nf = new AdminNotification();    // notification to admin 
                        $admin_nf->title = Auth::user()->name;
                        $admin_nf->message = 'subscribe to our ' . $plan->sub_type . ' plan';
                        $admin_nf->status = true;
                        $admin_nf->save();

                        $userdata = [
                            'title' => 'subscription',
                            'name' => 'Dear ' . Auth::user()->name,
                            'message' => 'you have successfully subscribe our ' . $plan->sub_type . 'plan, now you will get ' . $plan->discount . 'on every checkout',
                        ];

                        $clientsecret = $paymentIntent->client_secret;

                        return view('web.subscription.handle_3D_payment', compact('clientsecret', 'subscription_id'));
                    }
                } else if ($paymentIntent->status === 'requires_action') {

                    $sub = Subscription::where('stripe_subscription_id', $subscription_id)->first();
                    $plan = SubscriptionPlans::find($sub->plan_id);
                    $sub->update([
                        'amount' => $paymentIntent->amount,
                        'payment_status' => true,
                        'auto_renewal' => true,
                        'is_active' => true,
                    ]);

                    $admin_nf = new AdminNotification();    // notification to admin 
                    $admin_nf->title = Auth::user()->name;
                    $admin_nf->message = 'subscribe to our ' . $plan->sub_type . ' plan';
                    $admin_nf->status = true;
                    $admin_nf->save();

                    $userdata = [
                        'title' => 'subscription',
                        'name' => 'Dear ' . Auth::user()->name,
                        'message' => 'you have successfully subscribe our ' . $plan->sub_type . 'plan, now you will get ' . $plan->discount . 'on every checkout',
                    ];

                    $clientsecret = $paymentIntent->client_secret;
                    return view('web.subscription.handle_3D_payment', compact('clientsecret', 'subscription_id'));

                } else {

                    $paymentIntent->confirm();

                }

            } catch (\Exception $e) {

                return 'Error confirming payment intent: ' . $e->getMessage();

            }
        } else {
            $sub = Subscription::where('stripe_subscription_id', $subscription_id)->first();
            $plan = SubscriptionPlans::find($sub->plan_id);
            $sub->update([
                'payment_status' => true,
                'auto_renewal' => true,
                'is_active' => true,
            ]);

            $admin_nf = new AdminNotification();    // notification to admin 
            $admin_nf->title = Auth::user()->name;
            $admin_nf->message = 'subscribe to our ' . $plan->sub_type . ' plan';
            $admin_nf->status = true;
            $admin_nf->save();

            $userdata = [
                'title' => 'subscription',
                'name' => 'Dear ' . Auth::user()->name,
                'message' => 'you have successfully subscribe our ' . $plan->sub_type . 'plan, now you will get ' . $plan->discount . 'on every checkout',
            ];


        }
    }

    // handle confirm payment on 3D secure payment //
    public function confirmPayment(Request $request)
    {
        try {
            Stripe::setApiKey('sk_test_51OQ5lXSHuCTN4d6JX1bDDXk8y4bOe8XoHwO6kE7doayKqPmLiFX8tkKAu2QAx5YFxM53Vd7rhuaslc3zOuiSrdJe00rIQiC6mm');

            $clientSecret = $request->input('client_secret');

            $paymentIntent = PaymentIntent::retrieve($clientSecret);

            // $paymentIntent->confirm();

            $sub = Subscription::where('subscription_id', $request->input('subscription_id'))->first();
            $plan = SubscriptionPlans::find($sub->plan_id);
            $sub->update([
                'amount' => $paymentIntent->amount,
                'payment_status' => true,
                'auto_renewal' => true,
                'is_active' => true,
            ]);

            $admin_nf = new AdminNotification();    // notification to admin 
            $admin_nf->title = Auth::user()->name;
            $admin_nf->message = 'subscribe to our ' . $plan->sub_type . ' plan';
            $admin_nf->status = true;
            $admin_nf->save();

            $userdata = [
                'title' => 'subscription',
                'name' => 'Dear ' . Auth::user()->name,
                'message' => 'you have successfully subscribe our ' . $plan->sub_type . 'plan, now you will get ' . $plan->discount . 'on every checkout',
            ];
            return response()->json(['success' => true, 'payment_intent' => $paymentIntent]);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
