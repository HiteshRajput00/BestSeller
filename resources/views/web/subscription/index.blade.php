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

    <section id="pricing" class="pricing-content section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Subscription Plans</h2>
                <p>{{ trans("It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout.") }}</p>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                    data-wow-offset="0"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="pricing_design">
                        <div class="single-pricing">
                            <div class="price-head">
                                <h2>Starter</h2>
                                <h1>$0</h1>
                                <span>/Monthly</span>
                            </div>
                            <ul>
                                <li><b>15</b> website</li>
                                <li><b>50GB</b> Disk Space</li>
                                <li><b>50</b> Email</li>
                                <li><b>50GB</b> Bandwidth</li>
                                <li><b>10</b> Subdomains</li>
                                <li><b>Unlimited</b> Support</li>
                            </ul>
                            <div id="card-element">

                            </div>
                            <a href="#" class="price_btn">Order Now</a>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                    data-wow-offset="0"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="pricing_design">
                        <div class="single-pricing">
                            <div class="price-head">
                                <h2>Personal</h2>
                                <h1 class="price">$29</h1>
                                <span>/Monthly</span>
                            </div>
                            <ul>
                                <li><b>15</b> website</li>
                                <li><b>50GB</b> Disk Space</li>
                                <li><b>50</b> Email</li>
                                <li><b>50GB</b> Bandwidth</li>
                                <li><b>10</b> Subdomains</li>
                                <li><b>Unlimited</b> Support</li>
                            </ul>
                            <div class="pricing-price">

                            </div>
                            <a href="#" class="price_btn">Order Now</a>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                    data-wow-offset="0"
                    style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div class="pricing_design">
                        <div class="single-pricing">
                            <div class="price-head">
                                <h2>Ultimate</h2>
                                <h1 class="price">$49</h1>
                                <span>/Monthly</span>
                            </div>
                            <ul>
                                <li><b>15</b> website</li>
                                <li><b>50GB</b> Disk Space</li>
                                <li><b>50</b> Email</li>
                                <li><b>50GB</b> Bandwidth</li>
                                <li><b>10</b> Subdomains</li>
                                <li><b>Unlimited</b> Support</li>
                            </ul>
                            <div class="pricing-price">

                            </div>
                            <a href="#" class="price_btn">Order Now</a>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <style>
        body {
            margin-top: 20px;
            background: #DCDCDC;
        }

        .pricing-content {
            position: relative;
        }

        .pricing_design {
            position: relative;
            margin: 0px 15px;
        }

        .pricing_design .single-pricing {
            background: #554c86;
            padding: 60px 40px;
            border-radius: 30px;
            box-shadow: 0 10px 40px -10px rgba(0, 64, 128, .2);
            position: relative;
            z-index: 1;
        }

        .pricing_design .single-pricing:before {
            content: "";
            background-color: #fff;
            width: 100%;
            height: 100%;
            border-radius: 18px 18px 190px 18px;
            border: 1px solid #eee;
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: -1;
        }

        .price-head {}

        .price-head h2 {
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 600;
        }

        .price-head h1 {
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 5px;
        }

        .price-head span {}

        .single-pricing ul {
            list-style: none;
            margin-top: 30px;
        }

        .single-pricing ul li {
            line-height: 36px;
        }

        .single-pricing ul li i {
            background: #554c86;
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 30px;
            font-size: 11px;
            text-align: center;
            line-height: 20px;
            margin-right: 6px;
        }

        .pricing-price {}

        .price_btn {
            background: #554c86;
            padding: 10px 30px;
            color: #fff;
            display: inline-block;
            margin-top: 20px;
            border-radius: 2px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .price_btn:hover {
            background: rgb(230, 239, 243);
        }

        a {
            text-decoration: none;
        }

        .section-title {
            margin-bottom: 60px;
        }

        .text-center {
            text-align: center !important;
        }

        .section-title h2 {
            font-size: 45px;
            font-weight: 600;
            margin-top: 0;
            position: relative;
            text-transform: capitalize;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('pk_test_51O7AYgSIRjlSt6h3GKjXiN4vqP0Strd7vltj5qFHdb4eN8URJPGUNPbD00jwI1XiFyoMe50cPWN8lpnIs5AIOgVf002gg6Hlla');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
    </script>
@endsection
