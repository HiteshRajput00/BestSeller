<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ url('/admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/admin/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/vector-map/jqvmap.css') }}">
    <link href="{{ url('/admin/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/admin/assets/libs/css/profile.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ url('/admin/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/admin/assets/vendor/daterangepicker/daterangepicker.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Admin</title>
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
                <a class="navbar-brand" href="index.html">Admin DashBoard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <?php $data = App\Models\AdminNotification::class::where('status','=',1)->get(); ?>
                        @if ($data->isEmpty())

                            <li class="nav-item dropdown notification">
                                <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-fw fa-bell"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                    <li>
                                        <div class="notification-title"> Notification</div>
                                        <div id="messages"></div>
                                        <div class="list-group justify-center">
                                            <p>you don't have any new notification</p>

                                        </div>

                                    </li>
                                    <li>
                                        <div class="list-footer"> <a
                                                href="{{ url('/admin-dashboard/admin-notifications') }}">View
                                                all notifications</a></div>

                                    </li>
                                </ul>
                            </li>
                        @else
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
                                                    @php
                                                        $createdAt = \Carbon\Carbon::parse($d->created_at);
                                                        $timeGap = $createdAt->diffForHumans(); 
                                                    @endphp
                                                    <a href="#"
                                                        class="list-group-item list-group-item-action active">
                                                        <div class="notification-info">
                                                            <div class="notification-list-user-img"><img
                                                                    src="{{ url('/admin/assets/images/avatar-2.jpg') }}"
                                                                    alt=""
                                                                    class="user-avatar-md rounded-circle"></div>
                                                            <div class="notification-list-user-block"><span
                                                                    class="notification-list-user-name">{{ $d->title }}</span>{{ $d->message }}
                                                                <div class="notification-date">{{ $timeGap }}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <a class="btn btn-primary"
                                            href="{{ url('/admin-dashboard/Mark-as-readadmin-notification') }}">mark
                                            all as read</a>
                                    </li>
                                    <li>
                                        <div class="list-footer"> <a
                                                href="{{ url('/admin-dashboard/admin-notifications') }}">View
                                                all notifications</a></div>

                                    </li>
                                </ul>
                            </li>

                        @endif

                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php $image = App\Models\UserImage::class::where('user_id',Auth::user()->id)->first(); ?>
                                <img src="{{ url('/images/' . $image->profile_image ?? '') }}" alt=""
                                    class="user-avatar-md rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->name }}</h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="{{ url('/admin-dashboard/admin-profile') }}"><i
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
                                <a class="nav-link " href="{{ url('/admin-dashboard') }}"><i
                                        class="fa fa-fw fa-user-circle"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-2" aria-controls="submenu-2"><i
                                        class="fa fa-fw fa-shopping-cart"></i>Product </a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/admin-dashboard/product-request') }}">
                                                product
                                                request</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin-dashboard/product-approved') }}">approved
                                                product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin-dashboard/product-disapproved') }}">disapproved
                                                product</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-1" aria-controls="submenu-1"><i
                                        class="fa fa-fw fa-user-circle"></i>Designers <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/admin-dashboard/designer-list') }}">
                                                designer
                                                request</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin-dashboard/approved-designer') }}">approved
                                                designer</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin-dashboard/disapproved-designer') }}">disapproved
                                                disapproved</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-4" aria-controls="submenu-2"><i
                                        class="fa fa-fw fa-shopping-cart"></i>Product Category </a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/admin-dashboard/category-list') }}">
                                                list</a>
                                        </li>


                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-3" aria-controls="submenu-3"><i
                                        class="fa fa-fw fa-user-circle"></i>Users data <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/admin-dashboard/user-list') }}"> User
                                                list</a>
                                        </li>


                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-5" aria-controls="submenu-5"><i
                                        class="fa fa-fw fa-user-circle"></i>Subscription <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin-dashboard/add-subscription') }}"> Add new</a>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    {{-- <script src="../../../../cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="../../../../cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
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

</body>

</html>
