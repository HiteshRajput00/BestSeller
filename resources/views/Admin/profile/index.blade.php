{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/admin/assets/libs/css/profile.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Admin Profile</title>
</head>
<body> --}}

    @extends('Admin-layout.master')
    @section('content')
    <div class="container mt-5">
    
        <div class="row d-flex justify-content-center">
            
            <div class="col-md-10">
                
                <div class="card p-3 py-4">
                    
                    <div class="text-center">
                        <img src="{{url('/admin/assets/images/avatar-1.jpg')}}" width="100" class="rounded-circle">
                    </div>
                    {{-- <form action="/update-admin-profile" method="POST">
                        <button id="selectImageButton">
                            Select Image
                        </button>
                      <input type="file" id="hiddenImageInput" style="display: none">
                    </form> --}}
                    <div class="text-center mt-3">
                        <span class="bg-secondary p-1 px-4 rounded text-white">Profile</span>
                        <h5 class="mt-2 mb-0">{{ Auth::user()->name }}</h5>
                        <span>{{ Auth::user()->role }}</span>
                        
                        <div class="px-4 mt-1">
                            <p class="fonts">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        
                        </div>
                        
                         <ul class="social-list">
                            <li><i class="fa fa-facebook"></i></li>
                            <li><i class="fa fa-dribbble"></i></li>
                            <li><i class="fa fa-instagram"></i></li>
                            <li><i class="fa fa-linkedin"></i></li>
                            <li><i class="fa fa-google"></i></li>
                        </ul>
                        
                        <div class="buttons">
                            
                            <button class="btn btn-outline-primary px-4">Message</button>
                            <button class="btn btn-primary px-4 ms-3">Contact</button>
                        </div>
                        
                        
                    </div>
                    
                   
                    
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

    @endsection
{{-- </body>
</html> --}}