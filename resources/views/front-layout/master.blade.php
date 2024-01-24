<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">


    <title>Bestseller Ecommerce </title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ url('/user/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('/user/assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ url('/user/assets/css/templatemo-hexashop.css') }}">

    <link rel="stylesheet" href="{{ url('/user/assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ url('/user/assets/css/lightbox.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
    @include('sweetalert::alert')
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ url('/user/assets/images/logo.png') }}">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/"
                                    class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>

                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                    <li><a href="{{ url('shop') }}">Products</a></li>
                                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                                    <li><a href="{{ url('/subscription') }}">subscribe</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">Filter</a>
                                <ul>
                                    <?php $categories = App\Models\Categories::whereNull('parent_category_id')->get(); ?>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            @if ($category->products->isNotEmpty())
                                                <li>
                                                    <a href="{{ url('/explore?slug=' . $category->slug) }}"><i
                                                            class="fa fa-fw fa-tags"></i>{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif

                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="{{ url('/cart') }}"><i style="font-size: 1.6em"
                                        class="fa fa-shopping-cart"></i></a></li>
                            <li class="scroll-to-section"><a href="{{ url('/favourite') }}"><i
                                        style="font-size: 1.6em; color:red" class="fa fa-heart"></i></a></li>
                            {{-- search bar --}}
                            <li class="scroll-to-section">
                                <form action="{{ url('/search') }}" id="search_form" method="POST">
                                    @csrf
                                    <div id="search-container">
                                        <div id="search-bar" style="width: 500px">
                                            <input id="search-input" name="search" type="text"
                                                placeholder="Search...">
                                            <i id="search-icon" class="fa fa-times" onclick="closeSearch()"></i>
                                        </div>
                                        <p id="press"></p>
                                    </div>

                                    <i id="search-trigger" style="font-size: 1.4em;" class="fa fa-search"
                                        onclick="openSearch()"></i>
                                </form>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;"><i style="font-size: 1.6em; " class="fa fa-cog"></i></a>
                                <ul>
                                    @auth
                                        <li><a href="{{ url('/logout') }}">logout</a></li>
                                        <li>
                                            <a href="{{ url('/user-profile') }}">account setting</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/Account/profile/change-password') }}">Update Password</a>
                                        </li>
                                    @else
                                        <li><a href="{{ url('/login') }}">login</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->

        @yield('content')

        <!-- ***** Footer Start ***** -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="first-item">
                            <div class="logo">
                                <img src="{{ url('/user/assets/images/white-logo.png') }}"
                                    alt="hexashop ecommerce templatemo">
                            </div>
                            <ul>
                                <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                                <li><a href="#">hexashop@company.com</a></li>
                                <li><a href="#">010-020-0340</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h4>Shopping &amp; Categories</h4>
                        <ul>
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('explorecategory', ['slug' => $category->slug]) }}">{{ $category->name }}
                                            Shopping</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Homepage</a></li>
                            <li><a href="{{ url('/about-us') }}">About Us</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h4>Help &amp; Information</h4>
                        <ul>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">FAQ's</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Tracking ID</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="under-footer">
                            <p>Copyright © 2022 HexaShop Co., Ltd. All Rights Reserved.

                                <br>Design: <a href="https://templatemo.com" target="_parent"
                                    title="free css templates">TemplateMo</a>
                            </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <!-- jQuery -->
        {{-- <script src="{{ url('/user/assets/js/jquery-2.1.0.min.js') }}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


        <!-- Bootstrap -->
        <script src="{{ url('/user/assets/js/popper.js') }}"></script>
        <script src="{{ url('/user/assets/js/bootstrap.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
        <!-- Plugins -->
        <script src="{{ url('/user/assets/js/owl-carousel.js') }}"></script>
        <script src="{{ url('/user/assets/js/accordions.js') }}"></script>
        <script src="{{ url('/user/assets/js/datepicker.js') }}"></script>
        <script src="{{ url('/user/assets/js/scrollreveal.min.js') }}"></script>
        <script src="{{ url('/user/assets/js/waypoints.min.js') }}"></script>
        <script src="{{ url('/user/assets/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ url('/user/assets/js/imgfix.min.js') }}"></script>
        <script src="{{ url('/user/assets/js/slick.js') }}"></script>
        <script src="{{ url('/user/assets/js/lightbox.js') }}"></script>
        <script src="{{ url('/user/assets/js/isotope.js') }}"></script>

        <!-- Global Init -->
        <script src="{{ url('/user/assets/js/custom.js') }}"></script>

        <script>
            
            const form = document.getElementById('search_form');
            function openSearch() {
                document.getElementById('search-container').style.height = '60px';
            }

            function closeSearch() {
                document.getElementById('search-container').style.height = '0';
            }
            function handleKeyPress(event) {
                if (event.key === 'Enter') {
                    form.submit();
                }
            }
        </script>
        <script>
            $(function() {
                var selectedClass = "";
                $("p").click(function() {
                    selectedClass = $(this).attr("data-rel");
                    $("#portfolio").fadeTo(50, 0.1);
                    $("#portfolio div").not("." + selectedClass).fadeOut();
                    setTimeout(function() {
                        $("." + selectedClass).fadeIn();
                        $("#portfolio").fadeTo(50, 1);
                    }, 500);

                });
            });
        </script>

        <script>
            // add wishlist

            $(document).ready(function() {
                $('.addWishlist').click(function() {
                    var PID = $(this).data('id');
                    var iconID = $(this).attr('id');


                    $.ajax({
                        type: 'POST',
                        url: '{{ route('Add_Wishlist') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product_id: PID,


                        },
                        dataType: 'json',
                        success: function(response) {

                            $('#' + iconID).html(response.data);

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            // add wishlist

            $(document).ready(function() {
                $('.CartBtn').click(function() {
                    var ID = $(this).data('id');
                    var price = $(this).data('price');
                    var icon = $(this).attr('id');
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('Add_to_Cart') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product_id: ID,
                            price: price,

                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#' + icon).html(response.data);

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>


    </body>

    </html>
