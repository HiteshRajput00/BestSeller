@extends('front-layout.master')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="/home"> <h4>sign in</h4></a>
    
                            <form class="mt-5 mb-5 login-input" method="post" action="/loginprocess">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                                @if(session('msg'))
                                <div class="text text-danger">{{session('msg')}} </div>
                                @endif
                                <br>
                                <button class="btn login-form__btn submit w-100 btn-light" type="submit" name="log">Sign In</button>
                            </form>
                            <h4 style="color: black">Dont have account? <a href="/furni/register" class="btn btn-light">Sign Up</a> now</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection