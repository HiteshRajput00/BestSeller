@extends('Admin-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100 p-t-30">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="/home">
                                    <h4>Add Coupon</h4>
                                </a>
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form class="mt-5 mb-5 login-input" method="post"
                                    action="{{ url('/admin-dashboard/save-coupon') }}" >
                                   
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="coupon_code"
                                            placeholder="Coupon Code" name="coupon_code" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="discount"
                                            placeholder="discount percentage" name="discount" required>

                                        <div class="text text-danger">
                                            @error('discount')
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="" name="expiry_date">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="available_for" class="form-control" id="available_for">
                                            <option value="everyone">everyone</option>
                                            <option value="subscriber">subscriber only</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn login-form__btn submit w-100 btn-primary" name="save"
                                            type="submit">Add</button>
                                    </div>
                                </form>
                                <br>
                                <h3>Coupons list</h3>
                                <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8 p-l-10">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sno.</th>
                                                        <th scope="col">Coupon Code</th>
                                                        <th>discount</th>
                                                        <th scope="col">Available for</th>
                                                        <th>Expiry Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($coupons->isEmpty())
                                                    @else
                                                        @foreach ($coupons as $list)
                                                            <tr>
                                                                <td scope="row">{{ $loop->iteration }}</td>
                                                                <td>{{ $list->coupon_code }}</td>
                                                                <td>{{ $list->discount }}</td>
                                                                <td>{{ $list->available_for }}</td>
                                                                <td>{{ $list->expiry_date }}</td>
                                                                {{-- <td><a class="btn btn-primary" href="">edit</a></td>
                                                    <td><a class="btn btn-primary" href="">delete</a></td> --}}
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
