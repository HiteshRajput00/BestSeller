<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop Ecommerce HTML CSS Template</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{url('/user/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/user/assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{url('/user/assets/css/templatemo-hexashop.css')}}">

    <link rel="stylesheet" href="{{url('/user/assets/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{url('/user/assets/css/lightbox.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->
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
                        <a href="index.html" class="logo">
                            <img src="{{url('/user/assets/images/logo.png')}}">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                          
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="/about-us">About Us</a></li>
                                    <li><a href="/shop">Products</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="/contact-us">Contact Us</a></li>
                                  
                                    @if(Auth::user())
                                    <li><a href="/logout">logout</a></li>
                                    @else
                                    <li><a href="/login">login</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">Filter</a>
                                <ul>
                                    <?php $categories = App\Models\Categories::whereNull('parent_category_id')->get(); ?>
                                 @if($categories)
                                    @foreach($categories as $category)
                                    <li><a href="{{ route('explorecategory',['slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                 @endif
                                  
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
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
                            <img src="{{url('/user/assets/images/white-logo.png')}}" alt="hexashop ecommerce templatemo">
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
                        <li><a href="#">Men’s Shopping</a></li>
                        <li><a href="#">Women’s Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact Us</a></li>
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
                        
                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p>
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
    <script src="{{url('/user/assets/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{url('/user/assets/js/popper.js')}}"></script>
    <script src="{{url('/user/assets/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{url('/user/assets/js/owl-carousel.js')}}"></script>
    <script src="{{url('/user/assets/js/accordions.js')}}"></script>
    <script src="{{url('/user/assets/js/datepicker.js')}}"></script>
    <script src="{{url('/user/assets/js/scrollreveal.min.js')}}"></script>
    <script src="{{url('/user/assets/js/waypoints.min.js')}}"></script>
    <script src="{{url('/user/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{url('/user/assets/js/imgfix.min.js')}}"></script> 
    <script src="{{url('/user/assets/js/slick.js')}}"></script> 
    <script src="{{url('/user/assets/js/lightbox.js')}}"></script> 
    <script src="{{url('/user/assets/js/isotope.js')}}"></script> 
    
    <!-- Global Init -->
    <script src="{{url('/user/assets/js/custom.js')}}"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>