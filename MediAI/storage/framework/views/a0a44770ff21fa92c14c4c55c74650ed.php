<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
</head>

    <style>

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        a {
              text-decoration: none; /* Remove underline */
              color: inherit; /* Use the default text color */
        }

        .error-message {
            display: none;
            color: red;
        }

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

    </style>
<body>
    
    <div id="loader-wrapper" class="d-none">
        <div class="loader"></div>
    </div>

    <section style="height: 92vh">
        <div class="container-fluid" style="height: 92vh; background-color: hsl(0, 0%, 96%)">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="<?php echo e(asset('img/loginWallPaper.webp')); ?>" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                  <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                  
      
                  <a href="<?php echo e(route('login/google')); ?>" ><button type="button" class="btn btn-mediai btn-floating mx-1">
                    <i class="fab fa-google"></i> Google
                  </button></a>
      
                  
                </div>
      
                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0">Or</p>
                </div>
      
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3" required name="email" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" />
                  <label class="form-label" for="form3Example3">Email address</label>
                  <p class="error-message" id="emailError">Email cannot be empty.</p>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-3">
                  <input type="password" id="form3Example4" required name="password" class="form-control form-control-lg"
                    placeholder="Enter password" />
                  <label class="form-label" for="form3Example4">Password</label>
                  <p class="error-message" id="passwordError">Password cannot be empty.</p>
                </div>
      
                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Remember me
                    </label>
                  </div>
                  <a href="#!" class="text-body">Forgot password?</a>
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="button" class="btn btn-mediai btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="login()">Login</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register"
                      class="link-danger">Register</a></p>
                </div>
      
              
            </div>
          </div>
        </div>
      </section>

      <div style="height: 8vh"
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-mediai">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
          Copyright © 2024. All rights reserved.
        </div>
        <!-- Copyright -->
    
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
        <!-- Right -->
      </div>
      
        <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>    
        <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
        <script>
  
            $(document).ready(function(){
    
                // Set up your AJAX request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
            });

            function show_loader(){
                $('#loader-wrapper').removeClass("d-none");
            }

            function hide_loader(){
                $('#loader-wrapper').addClass("d-none");
            }

            function login(){

                const email = document.getElementById('form3Example3').value.trim();
                const password = document.getElementById('form3Example4').value.trim();

                let isValid = true;

                // Check email format
                if (email =='') {
                    document.getElementById('emailError').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('emailError').style.display = 'none';
                }

                // Check password format
                if (password == '') {
                    document.getElementById('passwordError').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('passwordError').style.display = 'none';
                }

                if (!isValid) {
                    return; // Prevent form submission if there are errors
                }
                show_loader()
                $.ajax({
                    url: "/auth/login",
                    method: "POST", // or "GET" as needed
                    data: {
                        email:     email,
                        password:  password
                    },
                    success: function (data) {

                        window.location.href = "<?php echo e(route('home')); ?>";
                        
                    },
                    error: function (error) {
                        console.error("AJAX error:", error);
                        var responseObject = JSON.parse(error.responseText);
                        var errorMessage = responseObject.message;
                        if (responseObject.errors) {
                            var errors = Object.values(responseObject.errors).flat().join("\n");
                            errorMessage += "\nErrors:\n" + errors;
                        }
                        alert(errorMessage);
                        hide_loader();
                    }
                });

            }
      </script>
  </body>
</html><?php /**PATH C:\wamp64\www\mediAI\resources\views/Authentication/login.blade.php ENDPATH**/ ?>