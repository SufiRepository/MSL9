<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/dist/css/adminlte.min.css') }}" />

    <style>
        .login-background {
            background-image: url("{{ asset('images') }}/citybg.jpg");
            background-size: cover;
        }
    </style>

</head>

<body class="hold-transition login-page login-background">
    <div class="login-box">
        <div class="login-logo">
            <a href="/" style="color: white;"><b>MSL9</b>V1</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

                <form action="recover-password.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/">Login</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('getregister') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ URL::asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins//bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('adminlte3/dist/js/adminlte.js') }}"></script>
</body>

</html>
