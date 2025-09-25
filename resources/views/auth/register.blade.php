<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <p class="login-box-msg">Sign up to create a new account</p>

      <form action="/register" method="post">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
          @error('name')
            <div class="text-danger mb-1" style="font-size: 90%;">{{ $message }}</div>
          @enderror
          <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
        </div>

        {{-- Email --}}
        <div class="mb-3">
          @error('email')
            <div class="text-danger mb-1" style="font-size: 90%;">{{ $message }}</div>
          @enderror
          <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        </div>

        {{-- Password --}}
        <div class="mb-3">
          @error('password')
            <div class="text-danger mb-1" style="font-size: 90%;">{{ $message }}</div>
          @enderror
          <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            <div class="input-group-append">
              <div class="input-group-text" style="cursor:pointer">
                <span class="fas fa-lock toggle-password" data-target="#password"></span>
              </div>
            </div>
          </div>
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
          @error('confirm_password')
            <div class="text-danger mb-1" style="font-size: 90%;">{{ $message }}</div>
          @enderror
          <div class="input-group">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" id="confirm_password">
            <div class="input-group-append">
              <div class="input-group-text" style="cursor:pointer">
                <span class="fas fa-lock toggle-password" data-target="#confirm_password"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign up using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-0">
        <a href="/login" class="text-center">Already have an account? Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
  $(function() {
    $('.toggle-password').on('click', function() {
      const target = $(this).data('target');
      const input = $(target);
      const type = input.attr('type') === 'password' ? 'text' : 'password';
      input.attr('type', type);
      $(this).toggleClass('fa-lock fa-lock-open');
    });
  });
</script>

</body>
</html>
