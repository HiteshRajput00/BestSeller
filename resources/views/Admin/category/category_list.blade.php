@extends('Admin-layout.master')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-10">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="W-25" scope="col"></th>
                                    <th scope="col">Sno.</th>
                            
                                    <th scope="col">image</th>
                                    <th scope="col">name</th>
                                    <th >parent_category</th>
                                    <th ></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cat_list as $list)
                                  <tr>
                                    <td></td>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td><img src="{{url('/images/'.$list->image)}}" class="img-fluid product-thumbnail" height="100px" width="100px"></td>
                                    <td>{{$list->name}}</td>
                                    <td></td>
                                    <td><a class="btn btn-primary" href="">edit</a></td>
                                    <td><a class="btn btn-primary" href="">delete</a></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection