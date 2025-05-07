<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>College Admin Register</title>
    <meta name="description" content="College Admin Registration Page">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>
<body>

<div class="login-page">
  <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
      <div class="row">

        <!-- Info Panel -->
        <div class="col-lg-6">
          <div class="info d-flex align-items-center">
            <div class="content">
              <div class="logo">
                <h1>College Dashboard</h1>
              </div>
              <p>Register your college admin account to start managing students, companies, and supervisors efficiently.</p>
            </div>
          </div>
        </div>

        <!-- Registration Form -->
        <div class="col-lg-6 bg-white">
          <div class="form d-flex align-items-center">
            <div class="content">
              <form method="POST" action="{{ route('register') }}" class="form-validate">
                @csrf

                <div class="form-group">
                  <input id="register-name" type="text" name="name" required data-msg="Please enter your name" class="input-material">
                  <label for="register-name" class="label-material">Name</label>
                </div>

                <div class="form-group">
                  <input id="register-email" type="email" name="email" required data-msg="Please enter a valid email" class="input-material">
                  <label for="register-email" class="label-material">Email</label>
                </div>

                <div class="form-group">
                  <input id="register-password" type="password" name="password" required data-msg="Please enter a password" class="input-material">
                  <label for="register-password" class="label-material">Password</label>
                </div>

                <div class="form-group">
                  <input id="register-password-confirm" type="password" name="password_confirmation" required data-msg="Please confirm your password" class="input-material">
                  <label for="register-password-confirm" class="label-material">Confirm Password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>

              </form>

              <small>Already have an account?</small> <a href="{{ route('login') }}" class="login">Login</a>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/js/front.js') }}"></script>

</body>
</html>