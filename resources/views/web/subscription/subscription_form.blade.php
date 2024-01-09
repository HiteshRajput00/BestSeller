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
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            {{-- <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h4 >Address </h4>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">street</label>
                                        <input type="text" class="form-control" name="street" id="fullName"
                                            value="{{ Auth::user()->name }}" placeholder="street address">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="city">city</label>
                                        <input type="text" class="form-control" name="city" id="city"
                                            value="{{ Auth::user()->email }}" placeholder="city">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="state">state</label>
                                        <input type="text" class="form-control" name="state"
                                            value="{{ Auth::user()->number }}" id="state" placeholder="state">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="iMage">country</label>
                                        <input type="text" class="form-control" value="US" name="country"
                                            id="country" placeholder="country" readonly>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
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
                        'pk_test_51OQ5lXSHuCTN4d6J0eysWWMeFXsyJBKreckgJD5oP9bYVvTrxZFU3FmlByyKSamJVb2BF8n6KrE4HQJmP7MZDRvQ00tpNTRse7'
                    );
                    var elements = stripe.elements();

                    var card = elements.create('card');
                    card.mount('#cardNumber');

                    var form = document.getElementById('subscription-form');

                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        stripe.createToken(card).then(function(result) {
                            if (result.error) {
                                console.error(result.error.message);
                            } else {
                                var tokenInput = document.createElement('input');
                                tokenInput.setAttribute('type', 'hidden');
                                tokenInput.setAttribute('name', 'stripeToken');
                                tokenInput.setAttribute('value', result.token.id);
                                form.appendChild(tokenInput);
                                form.submit();
                            }
                        });
                    });
                </script>
            @endsection
