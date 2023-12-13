@extends('front-layout.master')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>About Our Company</h2>
                        <span>Awesome, clean &amp; creative HTML5 Template</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
    <div class="row justify-content-center h-100">
        <div class="container p-lg-5">
            <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8 p-l-10">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ url('/subscription-process') }}" id="subscription-form" method="post">
                            @csrf
                            <h4>Enter Card details </h4>
                          <br>
                          <input type="hidden" name="plan_id" value="{{ $id }}">
                          <br>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-control" id="cardNumber"></div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">make payment </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe(
            'pk_test_51O7AYgSIRjlSt6h3GKjXiN4vqP0Strd7vltj5qFHdb4eN8URJPGUNPbD00jwI1XiFyoMe50cPWN8lpnIs5AIOgVf002gg6Hlla'
        );
        var elements = stripe.elements();

        var card = elements.create('card');
        card.mount('#cardNumber');

        var form = document.getElementById('subscription-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display error to your user
                    console.error(result.error.message);
                } else {
                    // Add the token to the form and submit
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
@endsection
