
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Link to your favicon -->
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- Link to Material Design Iconic Font CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!-- Link to Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <!-- Link to Hamburgers CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <!-- Link to Animsition CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <!-- Link to Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <!-- Link to Date Range Picker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!-- Link to your main CSS file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>
    <!-- Your HTML content here -->
</head>



	<form  method="POST" id="registerForm" action="{{ route('users.afterlogin') }}">
        @csrf
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
					
					<span class="login100-form-title p-b-48">
					<img src="{{ asset('images/icons/emsi.png') }}"  height="100" width="100" >
</body>
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="email" name="email" id="email" class="form-control" required>
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
		

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="password" class="form-control" required>
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					
					
                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
							Log in
							</button>
						</div>
					</div>
					
					

					<div class="text-center p-t-115">
						<span class="txt1">
							You do not have an account?
						</span>
                        @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

						<a class="txt2" href={{ route('user.insc') }}>
							Sign up
						</a>
					</div>
				
			</div>
		</div>
	</div>
	</form>

	<div id="dropDownSelect1"></div>
	
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>



</body>
</html>