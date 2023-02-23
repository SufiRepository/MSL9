<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MSL9') }}</title>
    <link rel="shortcut icon" href="{{ url('images/anylogo.png') }}">
    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ URL::asset('fontawesome47/css/font-awesome.min.css') }}" /> --}}
    <!-- Tempusdominus Bootstrap 4 Time Picker-->
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
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/daterangepicker/daterangepicker.css') }}" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/summernote/summernote-bs4.min.css') }}" />

    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ URL::asset('adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fullcalendar/main.css') }}">

    {{-- page level css --}}
    @stack('css')

    <script src="{{ URL::asset('adminlte3/jquery.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('fullcalendar/dist/index.global.js') }}"></script> --}}
    <script src="{{ URL::asset('adminlte3/plugins/fullcalendar/main.js') }}"></script>


    {{-- BUANG ARROW SEKAT INPUT NUMBER --}}
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fbfbfb;
            transition: opacity 5s, visibility 0.75s;
        }

        .loader--hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader::after {
            content: "";
            width: 75px;
            height: 75px;
            border: 15px solid #dddddd;
            border-top-color: #000000;
            border-radius: 50%;
            animation: loading 0.75s ease infinite;
        }

        @keyframes loading {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }

        .main-sidebar {
            background-color: #1A3731 !important
        }
    </style>
    <script>
        window.addEventListener("load", () => {
            const myTimeout = setTimeout(myLoad, 2000);
            const loader = document.querySelector(".loader");

            function myLoad() {

                loader.classList.add("loader--hidden");

                loader.addEventListener("transitionend", () => {
                    document.body.removeChild(loader);
                });
            }

        });
    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        {{-- <div class="loader flex-column justify-content-center align-items-center"></div> --}}

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <img src="{{ url('images/spinner.gif') }}" alt="Preloader" height="30%" width="15%"> --}}
            <div class="loader"></div>
        </div>

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ url('images/anylogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MSL9</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="{{url('images/TDDM.png')}}" class="img-circle elevation-2" alt="User Image"> --}}
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                {{-- <div class="form-inline">
                  <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                      <button id="sidebarsearch" class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                      </button>
                    </div>
                  </div>
                </div> --}}

                @include('layouts.sidebarmenu')
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('contentheader')

            <section class="content">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://github.com/sufi-skyvett">SUFI REPO</a>.</strong>

            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1
            </div>
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('layouts.script')
    @stack('jscript')

</body>


</html>
