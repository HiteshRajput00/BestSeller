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
                        <h2>Your favourite products</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @if ($favourite)
                    @foreach ($favourite as $fav)
                        <?php $product = App\Models\Product::class::find($fav->product_id); ?>
                        <div class="col-lg-4">
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="{{ route('single_product', ['slug' => $product->slug]) }}"><i
                                                        class="fa fa-eye"></i></a></li>

                                            <li><a type="button" class="addWishlist" id="{{ $product->slug }}"
                                                    data-id="{{ $product->id }}"><i style="color: red"
                                                        class="fa fa-heart"></i></a></li>

                                            @if (Auth::user()->carts->where('product_id', $product->id)->isNotEmpty())
                                                <li><a type="button" id="{{ $product->id }}" class="CartBtn"
                                                        data-price="{{ $product->price }}" data-id="{{ $product->id }}"><i
                                                            style="color: green" class="fa fa-shopping-cart"></i></a></li>
                                            @else
                                                <li><a type="button" id="{{ $product->id }}" class="CartBtn"
                                                        data-price="{{ $product->price }}" data-id="{{ $product->id }}"><i
                                                            class="fa fa-shopping-cart"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <img src="{{ url('/images/' . $product->media->image ?? '') }}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>{{ $product->name }}</h4>
                                    <span>${{ $product->price }}</span>
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

                {{-- 
                <!----------------- Pagiination url() ----------->
                <div class="col-lg-12">
                    <div class="pagination">
                        @if ($product->lastPage() > 1)
                            <ul>
                                @if ($product->onFirstPage())
                                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                                        <li class="{{ $i == $product->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $product->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li>
                                        <a href="{{ $product->nextPageUrl() }}">></a>
                                    </li>
                                @elseif ($product->hasMorePages())
                                    <li>
                                        <a href="{{ $product->previousPageUrl() }}">
                                            < < /a>
                                    </li>

                                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                                        <li class="{{ $i == $product->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $product->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li>
                                        <a href="{{ $product->nextPageUrl() }}">></a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $product->previousPageUrl() }}">
                                            < < /a>
                                    </li>
                                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                                        <li class="{{ $i == $product->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $product->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                @endif
                            </ul>
                        @endif
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->



@endsection
