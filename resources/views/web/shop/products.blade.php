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
                        <h2>Our Latest Products</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @if($products)
                @foreach($products as $product)
                <div class="col-lg-4">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="{{route('single_product' ,['id'=>$product->id])}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                    <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <?php $img = App\Models\Media::class::where('product_id',$product->id)->first(); ?>
                            <img src="{{url('/images/'.$img->image ?? '')}}" alt="">
                        </div>
                        <div class="down-content">
                            <h4>{{ $product->name }}</h4>
                            <span>${{ $product->price }}</span>
                            <ul class="stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
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
                                 <a  href="{{ $products->url($i) }}">{{ $i }}</a>
                               </li>
                            @endfor
                               <li>
                                 <a href="{{ $products->nextPageUrl() }}">></a>
                               </li>
                         @elseif ($products->hasMorePages())
                               <li>
                                  <a href="{{ $products->previousPageUrl() }}"><</a>
                               </li>
                         
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                               <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                  <a  href="{{ $products->url($i) }}">{{ $i }}</a>
                               </li> 
                            @endfor
                               <li>
                                  <a href="{{ $products->nextPageUrl() }}">></a>
                               </li>
                          @else
                               <li>
                                   <a href="{{ $products->previousPageUrl() }}"><</a>
                               </li>
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                  <a  href="{{ $products->url($i) }}">{{ $i }}</a>
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