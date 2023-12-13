<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
  /**
     * Handle incoming webhook requests from Stripe.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
  public function handleWebhookResponse(Request $request)
  {
    Log::info('Webhook Headers:', $request->headers->all());

    $payload = file_get_contents('php://input');
$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];

try {
    $event = Webhook::constructEvent(
        $payload, $sigHeader, config('services.stripe.secret')
    );
      switch ($event->type) {
        case 'product.created':
          $subscriptionSchedule = $event->data->object;
        case 'price.created':
          $subscriptionSchedule = $event->data->object;
        case 'customer.subscription.created':
          $this->updateSubscriptionInDatabase($event->data->object);
        case 'customer.created':
          $subscriptionSchedule = $event->data->object;
          $this->updateCustomerDetails($event->data->object);
        case 'customer.card.created':
          $subscriptionSchedule = $event->data->object;
        case 'payment_intent.requires_action':
          $subscriptionSchedule = $event->data->object;
        case 'payment_intent.created':
          $subscriptionSchedule = $event->data->object;
        
        default:
          echo 'Received unknown event type ' . $event->type;
      }
    } catch (SignatureVerificationException $e) {
      // Invalid signature
      return response('Invalid signature.', 400);
    }

    // Return a 200 response to acknowledge receipt of the event
    return response('Webhook handled successfully', 200);
  }

       /**
     * Handle the specific event based on its type.
     *
     * @param  \Stripe\Event  $event
     * @return void
     */
  private function updateSubscriptionInDatabase($subscription)
  {
    $data = Subscription::where('stripe_subscription_id', $subscription->id)->first();
      if($data->isEmpty()){

      }else{
        $data->update(['payment_status' => $subscription->status,]);
      }
   

  }

  private function updateCustomerDetails($subscription)
  {
    // $data
  }
}

