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
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-12">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-5 order-2 order-lg-1">
                                    @if (session('success'))
                                        <div id="success-alert" class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Update Password</p>

                                    <form class="mx-1 mx-md-4" onsubmit="return validateForm()" method="post"
                                        action="{{ url('/Account/profile/update-password') }}">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="current_password"
                                                    placeholder="enter current password" name="current_password"
                                                    class="form-control" />
                                                <div class="text text-danger">
                                                    @error('current_password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                                @if (session('error'))
                                                    <div id="success-alert" class="text text-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" placeholder="enter new password"
                                                    name="new_password" class="form-control" />
                                                <div class="text text-danger">
                                                    @error('new_password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password_confirmation"
                                                    placeholder="confirm password" name="confirm_password"
                                                    class="form-control" />
                                                <div id="passwordError" class="text text-danger">
                                                    @error('confirm_password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="save"
                                                class="btn btn-dark btn-lg">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('password_confirmation').addEventListener('input', function() {
            var password = this.value;
            var confirmPassword = document.getElementById('password').value;

            if (password !== confirmPassword) {
                document.getElementById('passwordError').innerHTML = 'Passwords do not match.';
            } else {
                document.getElementById('passwordError').innerHTML = '';
            }
        });

        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                document.getElementById('passwordError').innerHTML = 'Passwords do not match.';
                return false; 
            } else {
                document.getElementById('passwordError').innerHTML = '';
                return true; 
            }
        }
    </script>
@endsection
