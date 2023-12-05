@extends('front-layout.master')
@section('content')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }


        /* Hide the div initially */
        #hiddenDiv {
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
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
    <section class="section p-4" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 p-5">
                    <div class="left-images">
                        @if ($media)
                            @foreach ($media as $img)
                                <img src="{{ url('/images/' . $img->image ?? '') }}" alt="{{ $product->slug }}"
                                    height="400px" width="300px">
                            @endforeach
                        @endif
                    </div>
                  
                        <form style="display: " method="post" action="/add-review">
                            @csrf
                            <div class="form-group">
                                <div class="rate">
                                    <input class="showRadio" type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input class="showRadio" type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input class="showRadio" type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input class="showRadio" type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input class="showRadio" type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <br>
                            </div>
                            <br>
                            <div id="hiddenDiv" class="form-group">
                                <label for="comment">Your Review:</label>
                                <textarea class="form-control" name="comment"></textarea>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <br>
                                <button class="btn btn-primary" type="submit">Submit Review</button>
                            </div>
                        </form>
                    
                </div>
                <div class="col-lg-6 p-5">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>
                        <span class="price">${{ $product->price }}</span>
                        @if ($review)
                            <ul class="stars">
                                @for ($i = 1; $i <= $review; $i++)
                                    <li><i style="color: #deb217" class="fa fa-star"></i></li>
                                @endfor

                            </ul>
                        @endif
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>{{ $product->description }}</p>
                        </div>
                        {{-- <div class="quantity-content">
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
                        </div> --}}

                        <div class="total p-5">
                            <h4>Total: $<strong id="total_price">{{ $product->price }}</strong></h4>
                            <div class="main-border-button"><a
                                    href="{{ route('Add_Cart', ['slug' => $product->slug]) }}">Add
                                    To Cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!------------------ ajax Script for increase or delete quantity --------------->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.showRadio').on('click', function() {
                if ($(this).is(':checked')) {
                    $('#hiddenDiv').show();
                } else {
                    $('#hiddenDiv').hide();
                }
            });
        });

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
