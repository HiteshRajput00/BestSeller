@extends('Admin-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="W-25" scope="col"></th>
                                            <th scope="col">Sno.</th>
                                            <th scope="col">name</th>
                                            <th>email</th>
                                            <th>number</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($designer_list as $list)
                                            <tr>
                                                <td></td>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->number }}</td>
                                                {{-- <td>  <a href="{{route('approve_designer',['id'=>$list->id])}}"   class=" btn btn-primary ">approve</a></td>
                                     <td>  <button data-designer-id="{{ $list->id }}" class="disapprove-button btn btn-danger ">Disapprove</button></td>
                                    <td><div id="disapproval-container"></div></td> --}}
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
