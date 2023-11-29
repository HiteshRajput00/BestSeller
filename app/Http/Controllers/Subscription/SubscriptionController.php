<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        $user->newSubscription('main', 'monthly')->create();

        return redirect()->route('dashboard')->with('success', 'Subscription created successfully!');
    }

    public function cancel(Request $request)
    {
        $user = $request->user();

        $user->subscription('main')->cancel();

        return redirect()->route('dashboard')->with('success', 'Subscription canceled successfully!');
    }
}
