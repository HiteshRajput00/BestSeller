@extends('Designer-layout.master')
@section('content')
    @include('sweetalert::alert')
    <div style="padding-left: 150px" class="login-form-bg h-100 p-t-30">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="/home">
                                    <h4>add category</h4>
                                </a>
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form class="mt-5 mb-5 login-input" method="post"
                                    action="/designer-dashboard/add-category-process" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cat_name"
                                            placeholder="category Name" name="category_name" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="sslug" placeholder="slug"
                                            name="slug" required>

                                        <div class="text text-danger">
                                            @error('category_image')
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="file" class="form-control" placeholder="" name="cat_image">
                                    </div>
                                    <br>

                                    <div class="form-group">

                                        <select id="parent_category"
                                            class="form-control @error('role') is-invalid @enderror" name="parent_category">
                                            <option value="">-Parent Category-</option>
                                            @if ($parent_category !== null)
                                                @foreach ($parent_category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button class="btn login-form__btn submit w-100 btn-primary" name="save"
                                            type="submit">add</button>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Automatically hide the success message after 3 seconds
            setTimeout(function() {
                $("#success-alert").fadeOut("slow");
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#cat_name').on('keyup', function() {
                let name = $(this).val().toLowerCase();
                let slug = name.replace(/\s+/g, "-");
                $('#sslug').val(slug);
            });
        });
    </script>
@endsection
