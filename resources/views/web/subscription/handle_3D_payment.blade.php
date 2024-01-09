@extends('front-layout.master')
@section('content')
<div class="container">

    <form id="payment-form">
        <input type="hidden" id="client-secret" name="client-secret" value="{{ $clientsecret }}">
        <input type="hidden" id="subscription" name="subscription" value="{{ $subscription_id }}">
     
    </form>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   var stripe = Stripe(
            'pk_test_51OQ5lXSHuCTN4d6J0eysWWMeFXsyJBKreckgJD5oP9bYVvTrxZFU3FmlByyKSamJVb2BF8n6KrE4HQJmP7MZDRvQ00tpNTRse7'
        );

    var clientSecret = document.getElementById('client-secret').value;
    var subscription = document.getElementById('subscription').value;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    stripe.handleCardPayment(clientSecret).then(function(result) {
        if (result.error) {
            console.error(result.error.message);
        } else {
            window.location.href = '{{ url('/') }}';
            confirmPaymentIntent(clientSecret, csrfToken);
    }});
    function confirmPaymentIntent(clientSecret, csrfToken) {
    $.ajax({
        url: '/confirm-payment', 
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            client_secret: clientSecret,
            subscription_id: subscription
        },
        success: function(response) {
            console.log(response);
            // window.location.href = '{{ url('/home') }}';
        },
        error: function(error) {
            console.error('Error confirming PaymentIntent:', error);
        }
    });
}
    
</script>
@endsection