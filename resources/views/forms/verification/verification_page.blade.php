@extends('front-layout.master')
@section('content')
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
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-12">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-10 col-xl-5 order-2 order-lg-1">
                                    <div class="card py-5 px-3">
                                        <h5 class="m-0">Mobile phone verification</h5><span class="mobile-text">Enter the
                                            code we just send on your
                                            mobile phone <b class="text-danger">+91 86684833</b></span>
                                        <form action="{{ url('/verify-otp') }}" method="post">
                                            @csrf
                                            <div class="d-flex flex-row mt-5">
                                                <input type="text" name="otp_num" class="form-control" autofocus="">
                                                <input type="hidden" name="user_id" value="{{ $id }}">
                                                {{-- <input type="hidden" name="email" value="{{ $email }}">    --}}
                                            </div>
                                            <div class="d-flex flex-row mt-5">
                                                <button type="submit" class="btn btn-primary">Verify</button>
                                            </div>
                                            <div class="text-center mt-5"><span class="d-block mobile-text">Don't receive
                                                    the code?</span>

                                                <a type="button" id="Resend_otp" class="font-weight-bold text-danger cursor"
                                                    data-value="{{ $value }}">Resend</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Resend_otp').click(function() {
                var value = $(this).data('value');
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/generate-otp') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        Otp_verify: value,
                    },
                    dataType: 'json',
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
