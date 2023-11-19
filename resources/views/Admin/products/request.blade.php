@extends('Admin-layout.master')
@section('content')
><!-- .nk-block-head -->
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-10">
            <div class="nk-block">
                <div class="row g-gs">
                    @foreach($products as $p)
                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                        <div class="gallery card card-bordered">
                            <a class="gallery-image popup-image" href="">
                                <?php $m = App\Models\Media::class::where('product_id',$p->id)->first(); ?>
                                <img class="w-100 rounded-top" src="{{url('/images/'.$m->image)}}" alt="">
                            </a>
                            <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                <div class="user-card">
                                    <div class="user-info" >
                                        <span class="lead-text">{{ $p->name ?? '' }}</span>
                                        <!-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleviewModal{{ $logo->id ?? '' }}" style="padding:0px;">
                                           View More
                                        </button> -->
                                        <a href="{{ url('admin-dashboard/logo-detail/'.$p->slug) }}">View More</a>
                                    </div>
                                </div>
                                <div class="">
                                    <a href="{{route('approve',['id'=>$p->id])}}"   class="btn btn-primary ">Approve</a>
                                    <a href="{{route('disapprove',['id'=>$p->id])}}"   class="btn btn-danger ">Disapprove</a>
                                </div>
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