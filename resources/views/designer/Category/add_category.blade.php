@extends('Designer-layout.master')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            
                                <a class="text-center" href="/home"> <h4>add category</h4></a>
    
                            <form class="mt-5 mb-5 login-input" method="post" action="/add-category-process" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="category Name" name="category_name" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="slug" name="slug" required>
                                
                                    <div class="text text-danger">@error('category_image'){{$message}} </div>
                                     
                                     @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="" name="cat_image" >
                                </div>
                                <br>
                               
                                <div class="form-group">
                                    
                                        <select id="parent_category" class="form-control @error('role') is-invalid @enderror" name="parent_category" >
                                            <option value="" >-Parent Category-</option>
                                            @if($parent_category !== null)
                                            @foreach ($parent_category as $cat )

                                                <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @endforeach
                                           @endif
                                        </select>
                                </div>
                                <br>
                                <div class="form-group">
                                <button class="btn login-form__btn submit w-100 btn-primary" name="save" type="submit">add</button>
                                </div>
                                        
                            </form>
                            <br>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection