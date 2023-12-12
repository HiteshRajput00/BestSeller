@extends('Admin-layout.master')
@section('content')
    <form action="{{ url('/admin-dashboard/add-subscription-process') }}" method="POST" enctype="multipart/form-data">
        <div class="row justify-content-center h-100">
            <div class="container">
                @csrf
                <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">add subscription</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">subscription plan</label>
                                        <div class="form-group">
                                            <select id="subscription_plan"
                                                class="form-control @error('subscription_plan') is-invalid @enderror"
                                                name="subscription_plan">
                                                <option value="Basic">-Basic-</option>
                                                <option value="personal">personal</option>
                                                <option value="ultimate">ultimate</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">recurring time</label>
                                        <div class="form-group">
                                            <select id="recurring_time"
                                                class="form-control @error('recurring_time') is-invalid @enderror"
                                                name="recurring_time">
                                                <option value="1">Monthly</option>
                                                <option value="6">Half yearly</option>
                                                <option value="12">yearly</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">price</label>
                                        <input type="text" class="form-control" name="price" id="phone"
                                            placeholder="Enter price">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="iMage">Discount percentage</label>
                                        <input type="text" class="form-control" name="Discount" id="Discount"
                                            placeholder="Enter Discount">
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary">submit</button>
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
