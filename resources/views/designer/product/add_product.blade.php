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
                                    action="/designer-dashboard/add-product-process" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="product Name"
                                            id="product_name" name="product_name" required>
                                    </div>
                                    <div class="text text-danger">
                                        @error('product_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="slug" placeholder="slug"
                                            name="slug" required>

                                        <div class="text text-danger">
                                            @error('category_image')
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="card-body pt-5">
                                        Product Image:
                                        <div id="imageDiv">
                                            <div class="form-group">
                                                <input type="file" class="form-control" placeholder="" name="image[]">
                                            </div>
                                            <div class="text text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <button type="button" id="addImageButton" class="btn btn-primary">Add more</button>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <select id="category" class="form-control @error('role') is-invalid @enderror"
                                            name="category">
                                            <option value="">- Category-</option>
                                            @if ($category !== null)
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="price" name="price"
                                            required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="enter stock" name="stock"
                                            required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <textarea name="description" id="description" class="form-control" placeholder="about product......"></textarea>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button class="btn login-form__btn submit w-100 btn-primary" name="save"
                                            type="submit">add product</button>
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
