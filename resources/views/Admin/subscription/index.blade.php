@extends('Admin-layout.master')
@section('content')

    <div class="row justify-content-center h-100">
        <div class="container p-lg-5">
            <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8 p-l-10">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ url('/admin-dashboard/add-subscription-process') }}" method="POST">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">add subscription</h6>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        @csrf
                                        <label for="fullName">subscription plan</label>
                                        <div class="form-group">
                                            <select id="subscription_plan"
                                                class="form-control @error('subscription_plan') is-invalid @enderror"
                                                name="subscription_plan">
                                                <option value="Basic">-Basic-</option>
                                                <option value="regular">-regular-</option>
                                                <option value="ultimate">-ultimate-</option>

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
                                                <option value="Monthly">Monthly</option>
                                                <option value="Half yearly">Half yearly</option>
                                                <option value="yearly">yearly</option>

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
                        </form>
                        <h3>plans list</h3>
                        <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8 p-l-10">
                            <div class="card h-100">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="W-25" scope="col"></th>
                                                <th scope="col">Sno.</th>
                                                <th scope="col">type</th>
                                                <th scope="col">cycle time</th>
                                                <th>discount</th>
                                                <th> Price </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($sub_list->isEmpty())
                                            @else
                                                @foreach ($sub_list as $list)
                                                    <tr>
                                                        <td></td>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $list->sub_type }}</td>
                                                        <td>{{ $list->recurring_time }}</td>
                                                        <td>{{ $list->discount }}</td>
                                                        <td>{{ $list->sub_price }}</td>
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

    <div class="row justify-content-center h-100">
        <div class="container p-lg-5">
            <div class="col-xl-12 col-lg-12 col-md-8 col-sm-8 col-8 p-l-10">

            </div>
        </div>
    </div>

@endsection
