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
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout.</p>
            </div>
            <div class="row text-center">
                @if ($sub_list->isNotEmpty())
                    @foreach ($sub_list as $list)
                        <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                            data-wow-offset="0"
                            style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="pricing_design">
                                <div class="single-pricing">
                                    <div class="price-head">
                                        <h2>{{ $list->sub_type }}</h2>
                                        <h1>${{ $list->sub_price }}</h1>
                                        <span>/{{ $list->recurring_time }}</span>
                                    </div>
                                    @if ($list->sub_type === 'Basic')
                                        <ul>
                                            <li><b>{{ $list->discount }}%</b> discount at every checkout </li>
                                            <li><b>Unlimited</b> Support</li>
                                        </ul>
                                    @endif
                                    @if ($list->sub_type === 'ultimate')
                                        <ul>
                                            <li><b>{{ $list->discount }}%</b> discount at every checkout </li>
                                            <li> <b>VIP</b> Membership</li>
                                            <li>no <b>shipping </b>cost</li>
                                            <li>no <b>taxt </b>involved</li>
                                            <li><b>Unlimited</b> Support</li>
                                        </ul>
                                    @endif
                                  <a href="{{ route('subscription_form',['id'=>$list->id]) }}" class="btn btn-primary"> order now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
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
            background: #d9d8e0;
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

@endsection
