<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/libs/css/profile.css') }}">
    <link href="{{ url('/admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/admin/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/vector-map/jqvmap.css') }}">
    <link href="{{ url('/admin/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/admin/assets/vendor/daterangepicker/daterangepicker.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Designer</title>
</head>

<body>
    @include('sweetalert::alert')
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">Designer DashBoard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <form action="{{ url('/search') }}" method="POST">
                                @csrf
                                <div id="custom-search" class="top-search-bar d-flex">
                                    <input class="form-control" name="search" type="text" placeholder="Search..">
                                    <div class="input-group-append ">
                                        <button class="btn btn-light" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <?php $data = App\Models\DesignerNotification::class::where('designer_id',Auth::user()->id)->where('status',1)->get(); ?>
                        @if ($data->isNotEmpty())
                            <li class="nav-item dropdown notification">
                                <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                    <li>
                                        <div class="notification-title"> Notification</div>
                                        <div class="notification-list">
                                            <div class="list-group">
                                                @foreach ($data as $d)
                                                    <a href="/designer-dashboard/designer-notifications"
                                                        class="list-group-item list-group-item-action active">
                                                        <div class="notification-info">
                                                            <div class="notification-list-user-img"><img
                                                                    src="{{url('/admin/assets/images/avatar-2.jpg')  }}"
                                                                    alt=""
                                                                    class="user-avatar-md rounded-circle"></div>
                                                            <div class="notification-list-user-block"><span
                                                                    class="notification-list-user-name">{{ $d->title }}</span>{{ $d->message }}
                                                                <div class="notification-date">2 min ago</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-footer"> <a
                                                href="{{ url('/designer-dashboard/designer-notifications') }}">View all
                                                notifications</a></div>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown notification">
                                <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-fw fa-bell"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                    <li>
                                        <div class="notification-title"> Notification</div>

                                        <div class="list-group justify-center">
                                            <p>you don't have any new notification</p>

                                        </div>

                                    </li>
                                    <li>
                                        <div class="list-footer"> <a
                                                href="{{ url('/designer-dashboard/designer-notifications') }}">View all
                                                notifications</a></div>

                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img
                                                    src="{{ url('/admin/assets/images/github.png') }}"
                                                    alt=""> <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img
                                                    src="{{ url('/admin/assets/images/dribbble.png') }}"
                                                    alt=""> <span>Dribbble</span></a>
                                        </div>
                                        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/slack.png" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div> --}}
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               
                                @if (Auth::user()->image)
                                    <img src="{{ url('/images/' . Auth::user()->image->profile_image ?? '') }}" alt=""
                                        class="user-avatar-md rounded-circle">
                                @else
                                    <img src="" alt="" class="user-avatar-md rounded-circle">
                                @endif

                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="{{ url('/designer-dashboard/profile') }}"><i
                                        class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                        class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->

        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ url('/designer-dashboard') }}"><i
                                        class="fa fa-fw fa-user"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-1" aria-controls="submenu-1"><i
                                        class="fa fa-fw fa-tags"></i>Category <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/designer-dashboard/add-category') }}"> add
                                                Category</a>
                                        </li>
                                        <li class="nav-item">
                                            {{-- <a class="nav-link" href="/category-list">category list</a> --}}
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-2" aria-controls="submenu-1"><i
                                        class="fa fa-fw fa-user-circle"></i>Product <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/designer-dashboard/add-product') }}"> add
                                                product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/designer-Dashboard/approved-product') }}">Approved
                                                Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/designer-Dashboard/disapproved-product') }}">Disapproved Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/designer-Dashboard/pending-product') }}">Pending
                                                Product</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->

        @yield('content')

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        {{-- <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>. 
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- jquery 3.3.1  -->
    <script src="{{ url('/admin/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ url('/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ url('/admin/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- chart chartist js -->
    <script src="{{ url('/admin/assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/chartist-bundle/Chartistjs.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/chartist-bundle/chartist-plugin-threshold.js') }}"></script>
    <!-- chart C3 js -->
    <script src="{{ url('/admin/assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <!-- chartjs js -->
    <script src="{{ url('/admin/assets/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/charts-bundle/chartjs.js') }}"></script>
    <!-- sparkline js -->
    <script src="{{ url('/admin/assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- dashboard finance js -->
    <script src="{{ url('/admin/assets/libs/js/dashboard-finance.js') }}"></script>
    <!-- main js -->
    <script src="{{ url('/admin/assets/libs/js/main-js.js') }}"></script>
    <!-- gauge js -->
    <script src="{{ url('/admin/assets/vendor/gauge/gauge.min.js') }}"></script>
    <!-- morris js -->
    <script src="{{ url('/admin/assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <script src="{{ url('/admin/assets/vendor/charts/morris-bundle/morrisjs.html') }}"></script>
    <!-- daterangepicker js -->
    {{-- <script src="../../../../cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
    {{-- <script src="../../../../cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
     @if(Session::get('error'))
     <script>
         toastr.clear();
         NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
     </script>
     @endif
     @if(Session::get('success'))
     <script>
         toastr.clear();
         NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
     </script>
     @endif
</body>

</html>
