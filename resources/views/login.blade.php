<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>College Admin Login</title>
    <meta name="description" content="College Admin Login Page">
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
        <div class="col-lg-6">
          <div class="info d-flex align-items-center">
            <div class="content">
              <div class="logo">
                <h1>User Login Dashboard</h1>
              </div>
              <p>Log in to access your account. Whether you're a College Admin, Student, Supervisor, or Company Representative , manage your tasks efficiently from here.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 bg-white">
          <div class="form d-flex align-items-center">
            <div class="content">

              {{-- Show validation errors --}}
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              {{-- Show inactive message --}}
              @if (session('inactive'))
                <div class="alert alert-warning">
                  {{ session('inactive') }}
                </div>
              @endif

              <form method="POST" action="{{ route('login') }}" class="form-validate">
                @csrf

                <div class="form-group">
                  <input id="login-email" type="email" name="email" required data-msg="Please enter your email" class="input-material">
                  <label for="login-email" class="label-material">Email</label>
                </div>

                <div class="form-group">
                  <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                  <label for="login-password" class="label-material">Password</label>
                </div>

                

                <button type="submit" class="btn btn-primary btn-block">Login</button>

              </form>

              <a href="#" class="forgot-pass">Forgot Password?</a><br>
              <small>Don't have an account?</small> <a href="{{ route('register') }}" class="signup">Signup</a>

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
