<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <style>
        /* Menampilkan pesan error dari jQuery Validator dengan warna merah */
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
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

      <p class="login-box-msg">Sign in to start your session</p>

      <form action="/login" method="post" id="loginForm">
        @csrf  
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text" style="cursor:pointer">
              <span id="togglePassword" class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="/register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="notificationModalBody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
  $(function() {
    $('#togglePassword').on('click', function() {
      const passwordInput = $('#password');
      const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
      passwordInput.attr('type', type);
      $(this)
        .toggleClass('fa-lock fa-lock-open');
    });
    
  $('#loginForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
        }
      },
      messages: {
        email: {
          required: "Please enter your email address",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please provide a password"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
      // Fungsi yang dijalankan setelah form valid
      submitHandler: function(form) {
        $.ajax({
          type: $(form).attr('method'),
          url: $(form).attr('action'),
          data: $(form).serialize(),
          dataType: 'json', // Harap pastikan controller Anda mengembalikan response JSON
          success: function(response) {
            // Jika controller mengembalikan {status: 'success'}
            $('#notificationModalTitle').text('Success');
            $('#notificationModalBody').text(response.message || 'Login successful! Redirecting...');
            $('#notificationModal').modal('show');
            
            // Redirect setelah 2 detik
            setTimeout(function() {
              window.location.href = response.redirect_url || '/dashboard';
            }, 2000);
          },
          error: function(xhr, status, error) {
            // Jika controller mengembalikan error (misal: 401 Unauthorized)
            let errorMessage = 'Invalid credentials. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            $('#notificationModalTitle').text('Login Failed');
            $('#notificationModalBody').text(errorMessage);
            $('#notificationModal').modal('show');
          }
        });
        return false; // Mencegah submit form standar
      }
    });
  });
</script>

</body>
</html>
