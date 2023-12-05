@extends('front-layout.master')
@section('content')
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Cart Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 px-lg-0">

        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-2 px-3 text-uppercase">Product</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Price</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Quantity</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Remove</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($Cart_data)
                                        @foreach ($Cart_data as $data)
                                            <?php $product = App\Models\Product::class::find($data->product_id); ?>
                                            <tr>
                                                <th scope="row" class="border-0">
                                                    <div class="p-2">
                                                        <?php $img = App\Models\Media::class::where('product_id',$product->id)->first(); ?>
                                                        <img src="{{ url('/images/' . $img->image ?? '') }}"
                                                            alt="{{ $product->slug }}" width="70"
                                                            class="img-fluid rounded shadow-sm">
                                                        <div class="ml-3 d-inline-block align-middle">
                                                            <h5 class="mb-0"> <a href="#"
                                                                    class="text-dark d-inline-block align-middle">{{ $product->name }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="border-0 align-middle"><strong>${{ $product->price }}</strong>
                                                </td>
                                                <td class="border-0 align-middle"><strong>{{ $data->quantity }}</strong>
                                                </td>
                                                <td class="border-0 align-middle"><a type="button" class="removeProduct"
                                                        data-id="{{ $data->id }}" class="text-dark"><i
                                                            class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php $total[] = $data->product_price; ?>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

                <div class="row py-5 p-4 bg-white rounded shadow-sm">
                    <div class="col-lg-6">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                        <div class="p-4">
                            <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                            <div class="input-group mb-4 border rounded-pill p-2">
                                <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3"
                                    class="form-control border-0">
                                <div class="input-group-append border-0">
                                    <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i
                                            class="fa fa-gift mr-2"></i>Apply coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller
                        </div>
                        <div class="p-4">
                            <p class="font-italic mb-4">If you have some information for the seller you can leave them in
                                the box below</p>
                            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                        <div class="p-4">
                            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you
                                have entered.</p>
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                        class="text-muted">Order Subtotal </strong><strong>${{ array_sum($total) }}</strong>
                                </li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                        class="text-muted">Shipping and handling</strong><strong>$0.00</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                        class="text-muted">Tax</strong><strong>$0.00</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                        class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold">${{ array_sum($total) }}</h5>
                                </li>
                            </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to
                                checkout</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Increase qty 
        const inputvalue = document.getElementById('QuantityInput');
        $(document).ready(function() {
            $('.removeProduct').click(function() {
                var ID = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('remove_product') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: ID,

                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#myTable').find('[data-id="' + ID + '"]').closest('tr').remove();
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
