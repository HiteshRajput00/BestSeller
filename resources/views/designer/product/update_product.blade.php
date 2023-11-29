@extends('Designer-layout.master')
@section('content')
    <div style="padding-left: 150px" class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-12">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="/home">
                                    <h4>Add Product</h4>
                                </a>
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form class="mt-5 mb-5 login-input" method="post"
                                    action="/designer-dashboard/update-product-process" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ $product->name ?? '' }}"
                                            placeholder="product Name" id="product_name" name="product_name" required>
                                    </div>
                                    <div class="text text-danger">
                                        @error('product_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="slug"
                                            value="{{ $product->slug ?? '' }}" placeholder="slug" name="slug" required>

                                        <div class="text text-danger">
                                            @error('slug')
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="text text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <br>
                                    @foreach ($media as $m)
                                        <div class="form-group">
                                            <input type="file" class="form-control" placeholder="" name="image[]">
                                        </div>
                                        <input type="hidden" class="form-control" placeholder="" name="image_id"
                                            value="{{ $m->id ?? '' }}">
                                        <div class="form-group">
                                            <img src="{{ url('/images/' . $m->image ?? '') }}"
                                                alt="{{ $product->name ?? '' }}" height="200px" width="250px">
                                            <span><button type="button" id="remove()"
                                                    class="btn btn-dark">X</button></span>
                                        </div>
                                    @endforeach
                                    <br>
                                    <button type="button" id="addImageButton" class="btn btn-primary">Add more</button>
                                    <br>
                                    <div class="form-group">
                                        <br>
                                        <input type="text" class="form-control" value="{{ $product->stock ?? '' }}"
                                            placeholder="price" name="price" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="enter stock"
                                            value="{{ $product->stock ?? '' }}" name="stock" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button class="btn login-form__btn submit w-100 btn-primary" name="save"
                                            type="submit">Update</button>
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
            $('#product_name').on('keyup', function() {
                let name = $(this).val().toLowerCase();
                let slug = name.replace(/\s+/g, "-"); // Replace consecutive spaces with a single dash
                $('#slug').val(slug);
            });
        });
    </script>
    <script>
        const selectContainer = document.getElementById('imageDiv');
        const addButton = document.getElementById('addImageButton');
        addButton.addEventListener('click', createSelectElement);

        function createSelectElement() {
            const imgdiv = document.createElement("div");
            imgdiv.setAttribute("class", "form-group")
            imgdiv.setAttribute("id", "imgdiv")
            var inputElement1 = document.createElement("input");
            inputElement1.setAttribute("type", "file")
            inputElement1.setAttribute("class", "form-control")
            inputElement1.setAttribute("placeholder", "select image")
            inputElement1.setAttribute("name", "image[]");
            inputElement1.setAttribute("id", "image");
            var selectContainer = document.getElementById("imageDiv");
            selectContainer.appendChild(inputElement1);


            //create delete button
            var button = document.createElement("button");
            button.innerHTML = "X";
            button.setAttribute("id", "delbtn");
            button.setAttribute("class", "btn btn-dark");
            button.setAttribute("type", "button");
            button.setAttribute("onclick", "remove()");
            selectContainer.appendChild(button);
            selectContainer.appendChild(imgdiv);

        }

        function remove() {
            const img = document.getElementById("image");
            img.remove();

            const delbtn = document.getElementById("delbtn");
            delbtn.remove();

        }
    </script>
@endsection
