<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
 
</head>
 <style>
        .design-block {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 92vh; /* Set height to 100% of viewport height */
        }

        .jumbotron-content {
            width: 100%;
            text-align: center;
        }

        .card {
            width: 100%;
        }

        .error-message {
            display: none;
            color: red;
        }
        
        a {
            text-decoration: none;
        }
    </style>
<body>

    <!-- div: Design Block -->
    <section class="design-block" style="height: 92vh;">
        <!-- Jumbotron -->
        <div class="jumbotron-content px-4 py-5 px-md-5 text-center text-lg-start design-block" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            The best offer <br />
                            <span class="text-primary">mediAI</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                          Experience precision healthcare with our AI-powered medical app. Our advanced algorithms deliver accurate diagnoses, 
                          while ensuring your privacy. Get personalized recommendations effortlessly through our intuitive interface. 
                          Join us for proactive health management.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                              
                                
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="row">
                                      <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                              <input type="text" id="form3Example1" required class="form-control" name="name" placeholder="Enter your first name"/>
                                              <label class="form-label" for="form3Example1">First name</label>
                                              <p class="error-message" id="firstNameError">Please enter a valid first name.</p>
                                          </div>
                                      </div>
                                      <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                              <input type="text" id="form3Example2" required name="last_name" class="form-control" placeholder="Enter your last name"/>
                                              <label class="form-label" for="form3Example2">Last name</label>
                                              <p class="error-message" id="lastNameError">Please enter a valid last name.</p>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Email input -->
                                  <div class="form-outline mb-4">
                                      <input type="email" id="form3Example3" required class="form-control" name="email" placeholder="Enter your email address"/>
                                      <label class="form-label" for="form3Example3">Email address</label>
                                      <p class="error-message" id="emailError">Please enter a valid email address.</p>
                                  </div>
                                  
                                  <!-- Phone input -->
                                  <div class="form-outline mb-4">
                                      <input type="text" name="phone" required id="form3Example4" class="form-control" placeholder="Enter your phone number"/>
                                      <label class="form-label" for="form3Example4">Phone number</label>
                                      <p class="error-message" id="phoneError">Please enter a valid phone number.</p>
                                  </div>
                                  
                                  <!-- Password input -->
                                  <div class="form-outline mb-4">
                                      <input type="password" required id="form3Example5" name="password" class="form-control" placeholder="Enter your password"/>
                                      <label class="form-label" for="form3Example5">Password</label>
                                      <p class="error-message" id="passwordError">Please enter a valid password.</p>
                                  </div>                                  
                                  <!-- Password input -->
                                  <div class="form-outline mb-4">
                                      <input type="password" required id="form3Example6" class="form-control" placeholder="Enter your password"/>
                                      <label class="form-label" for="form3Example5">Confirm password</label>
                                      <p class="error-message" id="ConfirmPasswordError">Passwords don't match.</p>
                                  </div>

                                    <div class="row justify-content-center">
                                      <div class="row justify-content-center mt-3">
                                        <!-- Submit button -->
                                        <button type="button" onclick="register()" class="btn btn-mediai btn-block mb-4">
                                            Sign up
                                        </button>
                                      </div>
                                    </div>

                                    <div class="text-center">
                                      <div class="row justify-content-center">
                                        <div class="row justify-content-center mt-3 mb-3">
                                            <span class="fw-bold mx-3">Or</span>
                                        </div>
                                      </div>
                                      

                                      <button type="button" class="btn btn-mediai btn-floating mx-1">
                                        <a href="/login/google" class="text-white"><i class="fab fa-google"></i></a> Google
                                      </button>
                          
                                      
                                  </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <div style="height: 8vh !important" class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-mediai">
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
    <!-- div: Design Block -->

    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
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

        function register(){

            const firstName = document.getElementById('form3Example1').value.trim();
            const lastName = document.getElementById('form3Example2').value.trim();
            const email = document.getElementById('form3Example3').value.trim();
            const phone = document.getElementById('form3Example4').value.trim();
            const password = document.getElementById('form3Example5').value.trim();
            const ConfirmPassword = document.getElementById('form3Example6').value.trim();

            let isValid = true;

            // Check first name format
            if (!/^[a-zA-Z]+$/.test(firstName) || firstName =='') {
                document.getElementById('firstNameError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('firstNameError').style.display = 'none';
            }

            // Check last name format
            if (!/^[a-zA-Z]+$/.test(lastName) || lastName =='') {
                document.getElementById('lastNameError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('lastNameError').style.display = 'none';
            }

            // Check email format
            if (!/\S+@\S+\.\S+/.test(email) || email =='') {
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('emailError').style.display = 'none';
            }

            // Check phone number format
            if (!/^\d{8}$/.test(phone) || phone =='') {
                document.getElementById('phoneError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('phoneError').style.display = 'none';
            }

            // Check password format
            if (password.length < 6) {
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('passwordError').style.display = 'none';
            }

            if (password != ConfirmPassword) {
                document.getElementById('ConfirmPasswordError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('ConfirmPasswordError').style.display = 'none';
            }

            if (!isValid) {
                return; // Prevent form submission if there are errors
            }
            show_loader();
            $.ajax({
                url: "/auth/register",
                method: "POST", // or "GET" as needed
                data: {
                    name:      firstName,
                    last_name: lastName,
                    phone:     phone,
                    email:     email,
                    password:  password
                },
                success: function (data) {

                  alert("Registered successfully!");
                  window.location.href = "<?php echo e(route('login')); ?>";
                    
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
</html>
<?php /**PATH C:\wamp64\www\mediAI\resources\views/Authentication/register.blade.php ENDPATH**/ ?>