@extends('Designer-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="nk-block">
                        <div class="row g-gs">
                            @if ($products->isNotEmpty())
                                @foreach ($products as $p)
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div style="padding-left: 1rem" class="gallery card card-bordered">
                                            <a class="gallery-image popup-image" href="">
                                                <img class="w-100 rounded-top" src="{{ url('/images/' . $p->media->image ?? '') }}"
                                                    alt="">
                                            </a>
                                            <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <h3 class="lead-text"><strong>{{ $p->name ?? '' }}</strong></h3>
                                                        <br>
                                                        <a class="btn btn-link"
                                                            href="{{ url('admin-dashboard/product-detail/' . $p->id) }}">View
                                                            More</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h3>you don't have any pending requests ...................</h3>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
