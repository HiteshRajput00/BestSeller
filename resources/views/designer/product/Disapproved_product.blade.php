@extends('Designer-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="nk-block">
                        <div class="row g-gs">
                            @foreach ($products as $p)
                                <div class="col-sm-6 col-lg-4 col-xxl-3">
                                    <div style="padding-left: 1rem" class="gallery card card-bordered">
                                        <a class="gallery-image popup-image" href="">
                                            
                                            <img class="w-100 rounded-top" src="{{ url('/images/' . $p->media->image) }}"
                                                alt="">
                                        </a>
                                        <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="lead-text">{{ $p->name ?? '' }}</span>
                                                    <a class="btn btn-link"
                                                        href="{{ url('admin-dashboard/product-detail/' . $p->id) }}">View
                                                        More</a>
                                                </div>
                                            </div>
                                            {{-- <div class="">
                                    <a href="{{route('Edit',['id'=>$p->id])}}"   class="btn btn-primary ">Edit</a>
                                    <a href="{{route('Delete',['id'=>$p->id])}}"   class="btn btn-danger ">Delete</a>
                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
