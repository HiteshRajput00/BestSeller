@extends('front-layout.master')
@section('content')

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Single Product Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-images">
                        @if ($media)
                            @foreach ($media as $img)
                                <img src="{{ url('/images/' . $img->image ?? '') }}" alt="{{ $product->slug }}"
                                    height="300px">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>
                        <span class="price">${{ $product->price }}</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>No. of Orders</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <button type="button" id="deleteQuantity" data-id="{{ $product->id }}"
                                        class="minus">-</button>
                                    <input type="text" id="QuantityInput" step="1" min="1" max=""
                                        name="quantity" value="1" title="Qty" class="input-text qty text"
                                        size="4">
                                    <button type="button" id="addQuantityBtn" data-id="{{ $product->id }}"
                                        class="minus">-</button>
                                </div>
                            </div>
                        </div>
                        <div class="total">
                            <h4>Total: $<strong id="total_price">{{ $product->price }}</strong></h4>
                            <div class="main-border-button"><a href="{{ route('Add_Cart', ['slug' => $product->slug]) }}">Add
                                    To Cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->

    <!------------------ ajax Script for increase or delete quantity --------------->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Increase qty 
        const inputvalue = document.getElementById('QuantityInput');
        $(document).ready(function() {
            $('#addQuantityBtn').click(function() {
                var ID = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('Increase_Quantity') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: ID,
                        qty: inputvalue.value,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#total_price').text(response.total_price);
                        inputvalue.value = response.newQty;
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
        // decrease qty
        $(document).ready(function() {
            $('#deleteQuantity').click(function() {
                var ID = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('decrease_Quantity') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: ID,
                        qty: inputvalue.value,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#total_price').text(response.total_price);
                        inputvalue.value = response.newQty;
                    },
                    error: function(xhr, status, error) {
                        // Log errors to the console
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
