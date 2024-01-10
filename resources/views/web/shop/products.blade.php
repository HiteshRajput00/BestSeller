@extends('front-layout.master')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Check Our Products</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                        <p class="text-white link-nav"><a class="follow-page" href="{{ url('/') }}">Home </a> <i class="fa fa-fw fa-arrow-right"></i>
                            <a class="follow-page" href="{{ url('/shop') }}"> Products</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Latest Products</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @if ($products)
                    @foreach ($products as $product)
                        <div class="col-lg-4">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="{{ route('single_product', ['slug' => $product->slug]) }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            @if (Auth::check())
                                                @if (Auth::user()->wishlists->where('product_id', $product->id)->isNotEmpty())
                                                    <li><a type="button" class="addWishlist"
                                                            id="{{ $product->slug ?? '' }}" data-id="{{ $product->id }}"><i
                                                                style="color: red" class="fa fa-heart"></i></a></li>
                                                @else
                                                    <li><a type="button" class="addWishlist" id="{{ $product->slug }}"
                                                            data-id="{{ $product->id }}"><i class="fa fa-heart"></i></a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->carts->where('product_id', $product->id)->isNotEmpty())
                                                    <li><a type="button" id="{{ $product->id }}" class="CartBtn"
                                                            data-price="{{ $product->price }}"
                                                            data-id="{{ $product->id }}"><i style="color: green"
                                                                class="fa fa-shopping-cart"></i></a></li>
                                                @else
                                                    <li><a type="button" id="{{ $product->id }}" class="CartBtn"
                                                            data-price="{{ $product->price }}"
                                                            data-id="{{ $product->id }}"><i
                                                                class="fa fa-shopping-cart"></i></a></li>
                                                @endif
                                            @else
                                                <li><a href="{{ url('/login') }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{ url('/login') }}"><i class="fa fa-shopping-cart"></i></a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                    <img src="{{ url('/images/' . $product->media->image ?? '') }}" alt="">

                                </div>
                                <div class="down-content">
                                    <h4>{{ $product->name }}</h4>
                                    <span><del>${{ $product->price + 150 }}</del>&nbsp;<strong>${{ $product->price  }}</strong></span>
                                    @if ($product->review)
                                        <ul class="stars">
                                            @for ($i = 1; $i <= $product->review->avg('rating'); $i++)
                                                <li><i style="color: #deb217" class="fa fa-star"></i></li>
                                            @endfor
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                <!----------------- Pagiination url() ----------->
                <div class="col-lg-12">
                    <div class="pagination">
                        @if ($products->lastPage() > 1)
                            <ul>
                                @if ($products->onFirstPage())
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li>
                                        <a href="{{ $products->nextPageUrl() }}">></a>
                                    </li>
                                @elseif ($products->hasMorePages())
                                    <li>
                                        <a href="{{ $products->previousPageUrl() }}">
                                            < </a>
                                    </li>

                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li>
                                        <a href="{{ $products->nextPageUrl() }}">></a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $products->previousPageUrl() }}">
                                            < </a>
                                    </li>
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
@endsection
