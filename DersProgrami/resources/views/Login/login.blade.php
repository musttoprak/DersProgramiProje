<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form id="loginForm" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mt-2 mb-3">
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
                <a href="register.html" class="text-center">Register a new membership</a>
            </p>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/dist/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Formun default submit işlemini engelliyoruz.

            var formData = $(this).serialize(); // Form verilerini alıyoruz.
            var token = "{{ csrf_token() }}"; // CSRF token'ı alıyoruz.

            $.ajax({
                type: 'POST',
                url: '{{ route('login') }}', // Login işleminin yapılacağı route
                data: formData + '&_token=' + token, // Form verilerini ve CSRF token'ı gönderiyoruz
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message)
                        window.location.href = '/'; // Başarılı ise anasayfaya yönlendir
                    } else {
                        toastr.warning(response.message) // Hata mesajı göster
                    }
                },
                error: function (xhr, status, error) {
                    toastr.warning('Bir hata oluştu: ' + error); // Ajax hatası
                }
            });
        });
    });
</script>
</body>
</html>
