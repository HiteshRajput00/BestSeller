@extends('Admin-layout.master')
@section('content')
<!-- .nk-block-head -->
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
                                    <button data-product-id="{{ $p->id }}" class="disapprove-button btn btn-danger ">Disapprove</button></div>
                                    <br>
                                <div id="disapproval-container"></div>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.disapprove-button').on('click', function () {
            var productId = $(this).data('product-id');
            createDisapprovalForm(productId);
        });

        function createDisapprovalForm(productId) {
            var form = $('<form>', {
                method: 'POST',
                action: '/disapproveProduct-Process', // Change this URL to your disapproval route
            });

            // Create a hidden input for the product ID
            var productIdInput = $('<input>', {
                type: 'hidden',
                name: 'product_id',
                value: productId,
            });

            form.append('@csrf');
            // Create a textarea element
            var textarea = $('<textarea>', {
                name: 'disapproval_reason',
                placeholder: 'Enter reason for disapproval',
                rows: '4',
                cols: '30',
                class: 'form-control'
            });

            // Create a submit button
            var submitButton = $('<button>', {
                type: 'submit',
                text: 'Submit',
                class: 'btn btn-primary'
            });

            // Append the hidden input, textarea, and submit button to the form
            form.append(productIdInput, textarea, submitButton);

            // Append the form to the container
            $('#disapproval-container').html(form);
        }
    });
</script>

@endsection