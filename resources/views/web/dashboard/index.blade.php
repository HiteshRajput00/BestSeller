@extends('front-layout.master')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>We Are Hexashop</h4>
                                <span>Awesome, clean &amp; creative HTML5 Template</span>
                                <div class="main-border-button">
                                    <a href="#">Purchase Now!</a>
                                </div>
                            </div>
                            <img src="{{ url('/user/assets/images/left-banner-image.jpg') }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            @if (isset($categories))
                                @foreach ($categories as $category)
                                    <?php $products = App\Models\Product::class::where('Category_id',$category->id)->get(); ?>
                                    @if ($products->isNotEmpty())
                                        <div class="col-lg-6">
                                            <div class="right-first-image">
                                                <div class="thumb">
                                                    <div class="inner-content">
                                                        <h4>{{ $category->name }}</h4>
                                                        <span>Best Clothes For Women</span>
                                                    </div>
                                                    <div class="hover-content">
                                                        <div class="inner">
                                                            <h4>{{ $category->name }}</h4>

                                                            <div class="main-border-button">
                                                                <a
                                                                    href="{{ route('explorecategory', ['slug' => $category->slug]) }}">Discover
                                                                    More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{ url('/images/' . $category->image ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    @if (isset($categories))
        @foreach ($categories as $category)
            <?php $products = App\Models\Product::class::where('Category_id',$category->id)->get(); ?>
            @if ($products->isNotEmpty())
                <section class="section" id="men">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="section-heading">
                                    <h2>{{ $category->name }} Latest</h2>
                                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="men-item-carousel">
                                    <div class="owl-men-item owl-carousel">
                                        @foreach ($products as $product)
                                            <?php $media = App\Models\Media::class::where('product_id',$product->id)->first(); ?>
                                            <div class="item">
                                                <div class="thumb">
                                                    <div class="hover-content">
                                                        <div class="inner">
                                                            <h4>{{ $product->name }}</h4>
                                                            <p>{{ $product->description }}</p>
                                                            <div class="main-border-button">
                                                                <a
                                                                    href="{{ route('single_product', ['slug' => $product->slug]) }}">Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{ url('/images/' . $media->image ?? '') }}">
                                                </div>
                                                <div class="down-content">
                                                    <h4>{{ $product->name }}</h4>
                                                    <span>${{ $product->price }}</span>
                                                    <?php $review = App\Models\ProductReview::class::
                                                     where('product_id', $product->id)
                                                    ->avg('rating'); ?>
                                                    @if ($review)
                                                        <ul class="stars">
                                                            @for ($i = 1; $i <= $review; $i++)
                                                                <li><i style="color: #deb217" class="fa fa-star"></i></li>
                                                            @endfor
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <!-- ***** Explore Area Starts ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Explore Our Products</h2>
                        <span>You are allowed to use this HexaShop HTML CSS template. You can feel free to modify or edit
                            this layout. You can convert this template as any kind of ecommerce CMS theme as you
                            wish.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>You are not allowed to redistribute this template ZIP file on any other website.</p>
                        </div>
                        <p>There are 5 pages included in this HexaShop Template and we are providing it to you for
                            absolutely free of charge at our TemplateMo website. There are web development costs for us.</p>
                        <p>If this template is beneficial for your website or business, please kindly <a rel="nofollow"
                                href="https://paypal.me/templatemo" target="_blank">support us</a> a little via PayPal.
                            Please also tell your friends about our great website. Thank you.</p>
                        <div class="main-border-button">
                            <a href="products.html">Discover More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Leather Bags</h4>
                                    <span>Latest Collection</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="{{ url('/user/assets/images/explore-image-01.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="{{ url('/user/assets/images/explore-image-02.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Different Types</h4>
                                    <span>Over 304 Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Social Media</h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Fashion</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-01.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>New</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-02.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Brand</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-03.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Makeup</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-04.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Leather</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-05.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Bag</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ url('/user/assets/images/instagram-06.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->

    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>By Subscribing To Our Newsletter You Can Get 30% Off</h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="name" type="text" id="name" placeholder="Your Name"
                                        required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your Email Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <button type="button" id="form-submit" class="main-dark-button"><i
                                            class="fa fa-paper-plane"></i></button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li>Store Location:<br><span>Sunny Isles Beach, FL 33160, United States</span></li>
                                <li>Phone:<br><span>010-020-0340</span></li>
                                <li>Office Location:<br><span>North Miami Beach</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>Work Hours:<br><span>07:30 AM - 9:30 PM Daily</span></li>
                                <li>Email:<br><span>info@company.com</span></li>
                                <li>Social Media:<br><span><a href="#">Facebook</a>, <a
                                            href="#">Instagram</a>, <a href="#">Behance</a>, <a
                                            href="#">Linkedin</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Subscribe Area Ends ***** -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe(
            'pk_test_51O7AYgSIRjlSt6h3GKjXiN4vqP0Strd7vltj5qFHdb4eN8URJPGUNPbD00jwI1XiFyoMe50cPWN8lpnIs5AIOgVf002gg6Hlla'
        );
        document.getElementById('form-submit').addEventListener('click', function() {
            // var inputValue = $('#inputtotal').val();
            // const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch('/subscription-process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: JSON.stringify({

                    }),
                })
                .then(response => response.json())
                .then(Product => {
                    return stripe.redirectToCheckout({
                        ProductID: Product.id
                    });
                })
                .then(result => {
                    // Handle the result
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

@endsection
