<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" />
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/jqvmap/jqvmap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/dist/css/adminlte.min.css') }}" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" />

    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />

    {{-- page level css --}}
    @stack('css')

    <style>
        body,
        html {
            /*background-color: #4e73df;*/
            /* background-image: -webkit-gradient(linear, left top, left bottom, color-stop(10%, #4e73df), to(#224abe)); */
            /*background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);*/
            background-image: url("{{ asset('images') }}/citybg.jpg");
            background-size: cover;
        }

        .background {
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .login-box {
            width: 700px;
            height: 500px;
        }

        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
    </style>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}" style="color:white;font-size:90px"><b>MSL9</b></a><br>
            {{-- <a href="{{ url('/') }}" style="color:white;font-size:50px">Management System Laravel 9</a> --}}

        </div>
        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card">
            <div class="card-body login-card-body">
                <h5>
                    <p class="login-box-msg" style="font-size:30px">Login</p>
                </h5>

                <form method="post" action="{{ route('newlogin') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        @error('throttle')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" placeholder="Password"
                            class="form-control @error('email') is-invalid @enderror" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        {{-- @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror --}}

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="true">
                                <label for="remember" style="font-size: 12px;font-weight: normal;">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    {{-- <a href="{{ route('contactadmin') }}">Lupa Kata Laluan?</a> --}}
                </p>
                <p class="mb-0">
                    {{-- <a href="{{ route('register') }}" class="text-center">Permohonan Pendaftaran Pengguna</a> --}}
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>

    </div>
    <!-- /.login-box -->


    <script src="{{ URL::asset('adminlte3/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte3/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte3/plugins/pdfmake/vfs_fonts.js') }}"></script>


    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ URL::asset('adminlte3/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ URL::asset('adminlte3/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    {{-- <script src="{{ URL::asset('adminlte3/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}

    {{-- <script src="{{ URL::asset('adminlte3/adminlte3/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src="{{ URL::asset('adminlte3/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
    <!-- daterangepicker -->
    <script src="{{ URL::asset('adminlte3/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ URL::asset('adminlte3/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ URL::asset('adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    {{-- <script src="{{ URL::asset('adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('adminlte3/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ URL::asset('adminlte3/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ URL::asset('adminlte3/dist/js/pages/dashboard.js') }}"></script> --}}

</body>

</html>
