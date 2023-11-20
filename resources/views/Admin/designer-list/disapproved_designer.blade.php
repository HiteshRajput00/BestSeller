@extends('Admin-layout.master')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-11">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="W-25" scope="col"></th>
                                    <th scope="col">Sno.</th>
                                    <th scope="col">name</th>
                                    <th >email</th>
                                    <th >number</th>
                                    <th class="W-25" scope="col">Disapprovel Reason</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($designer_list as $list)
                                    <?php $r = App\Models\disapprovedDesigner::class::where('designer_id','=',$list->id)->first(); ?>
                                  <tr>
                                    <td></td>
                                    <td scope="row">{{$loop->iteration}}</td>
                                     <td>{{$list->name}}</td>
                                     <td>{{$list->email}}</td>
                                     <td>{{$list->number}}</td>
                                     <td>{{$r->reason}}</td>
                                     <td>
                                      <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                      </svg> </a>
                                 
                                          </td>
                                          {{-- <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                            <li class="connection-list">
                                              <a href="{{route('approve_designer',['id'=>$list->id])}}"   class=" btn btn-primary ">approve</a>
                                            </li>
                                        </ul> --}}
                  
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