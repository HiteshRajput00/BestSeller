@extends('front-layout.master')
@section('content')
    <style>
        body {
            margin: ;
            padding-top: 40px;

            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .container {
            padding-left: 20px;
        }

        .account-settings .user-profile {

            margin: 1rem 1rem 1rem 1rem;
            padding-bottom: 1rem;
            text-align: center;
        }

        .account-settings .user-profile .user-avatar {
            margin: 0 0 1rem 0;
        }

        .account-settings .user-profile .user-avatar img {
            width: 90px;
            height: 90px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .account-settings .user-profile h5.user-name {
            margin: 0 0 0.5rem 0;
        }

        .account-settings .user-profile h6.user-email {
            margin: 0;
            font-size: 0.8rem;
            font-weight: 400;
            color: #9fa8b9;
        }

        .account-settings .about {
            margin: 2rem 0 0 0;
            text-align: center;
        }

        .account-settings .about h5 {
            margin: 0 0 15px 0;
            color: #007ae1;
        }

        .account-settings .about p {
            font-size: 0.825rem;
        }

        .form-control {
            border: 1px solid #cfd1d8;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-size: .825rem;
            background: #ffffff;
            color: #2e323c;
        }

        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }
    </style>
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Contact Us</h2>
                        <span>Awesome, clean &amp; creative HTML5 Template</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
    <form action="{{ url('/profile-update') }}" method="POST" enctype="multipart/form-data">
        <div class="row justify-content-center h-100">
            <div class="container">
                <div class="row gutters">

                    <div class="col-xl-3 col-lg-3 col-md-8 col-sm-8 col-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            @if (Auth::user()->image)
                                                <img src="{{ url('/images/' . Auth::user()->image->profile_image ?? '') }}"
                                                    alt="Maxwell Admin" height="250px" width="250px">
                                            @else
                                                <img src="{{ url('/admin/assets/images/product-pic.jpg') }}" alt="user"
                                                     height="250px" width="250px">
                                            @endif
                                        </div>
                                        <h4 class="user-name">{{ Auth::user()->name }}</h4>
                                        <h6 class="user-email">{{ Auth::user()->email }}</h6>
                                    </div>
                                    <div class="about">
                                        <h5>{{ Auth::user()->role }}</h5>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Personal Details</h6>
                                    </div>

                                    <input type="hidden" class="form-control" name="user_id"
                                        value="{{ Auth::user()->id }}">

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="fullName"
                                                value="{{ Auth::user()->name }}" placeholder="Enter full name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="eMail">Email</label>
                                            <input type="email" class="form-control" name="email" id="eMail"
                                                value="{{ Auth::user()->email }}" placeholder="Enter email ID">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone_number"
                                                value="{{ Auth::user()->number }}" id="phone"
                                                placeholder="Enter phone number">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="iMage">Profile photo</label>
                                            <input type="file" class="form-control" name="profile_image" id="iMage"
                                                placeholder="Select Image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            {{-- <button type="" id="submit" name="submit" class="btn btn-secondary">Cancel</button> --}}
                                            <button type="submit" id="submit" name="submit"
                                                class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
