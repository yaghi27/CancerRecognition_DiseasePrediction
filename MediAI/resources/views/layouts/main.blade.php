<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material-components-web.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>

    <style>
    
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3); /* Dark background with 30% opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it appears above other content */
        }

        .loader {
            border: 24px solid #f3f3f3;
            border-radius: 50%;
            border-top: 24px solid #3498db;
            width: 200px;
            height: 200px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        a {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Use the default text color */
        }
        .navbar-brand{
            color: white !important;
        }
        .nav-link{
            color: white !important;
        }
        .select2-selection__arrow{
            right: 10px !important
        }
        .select2-container{
            padding: 0px;
        }
    </style>

    <body style="background-color: hsl(0, 0%, 96%)">

        <nav style="height: 6vh !important; padding: 5px 20px;" class="navbar navbar-expand-md navbar-primary bg-mediai">
            <a class="navbar-brand">MediAI</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarsExampleDefault">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        @if (request()->url() === route('home'))
                            <a class="nav-link" style="font-weight: bold; cursor: default;">Home</a>
                        @else
                            <a class="nav-link" href="{{ route('home')}}">Home</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (request()->url() === route('disease_prediction'))
                            <a class="nav-link" style="font-weight: bold; cursor: default;">Disease prediction</a>
                        @else
                            <a class="nav-link" href="{{ route('disease_prediction')}}">Disease prediction</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (request()->url() === route('ct_scan'))
                            <a class="nav-link" style="font-weight: bold; cursor: default;">CT Scan</a>
                        @else
                            <a class="nav-link" href="{{ route('ct_scan')}}">CT Scan</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (request()->url() === route('history'))
                            <a class="nav-link" style="font-weight: bold; cursor: default;">History</a>
                        @else
                            <a class="nav-link" href="{{ route('history')}}">History</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (request()->url() === route('contact_us'))
                            <a class="nav-link" style="font-weight: bold; cursor: default;">Contact Us</a>
                        @else
                            <a class="nav-link" href="{{ route('contact_us')}}">Contact Us</a>
                        @endif
                    </li>
                </ul>
                <a href="{{route('/auth/logout')}}">
                    <button class="btn btn-danger my-2 my-sm-0">Logout</button>
                </a>
          </div>
        </nav>
                
        <div id="loader-wrapper" class="d-none">
            <div class="loader"></div>
        </div>

        @yield('content')

        <div style="height: 8vh !important" class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-mediai">
            
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">Copyright © 2024. All rights reserved.</div>

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/material-components-web.min.js') }}"></script>    
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>

        <script>

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            });

            function show_loader(){
                $('#loader-wrapper').removeClass("d-none");
            }

            function hide_loader(){
                $('#loader-wrapper').addClass("d-none");
            }
        </script>

        @yield('script')
    </body>
</html>
