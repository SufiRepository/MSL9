<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/fontawesome-free/css/all.min.css') }}"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"/>
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/jqvmap/jqvmap.min.css') }}"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/dist/css/adminlte.min.css') }}"/>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"/>
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/daterangepicker/daterangepicker.css') }}"/>
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/summernote/summernote-bs4.min.css') }}"/>

    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"/>

    {{-- page level css --}}
    @stack('css')

    <style>
        body,
        html {
            /*background-color: #4e73df;*/
            /* background-image: -webkit-gradient(linear, left top, left bottom, color-stop(10%, #4e73df), to(#224abe)); */
            /*background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);*/
            background-image: url("{{ asset('images') }}/BG.jpg");
            background-size: cover;
        }
        .background {
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            z-index: 0;
        }

        /* buang arrow dekat number */
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

    </style>

</head>
<body class="my-auto">
        <div class="register-logo">
            <a href="{{ url('/') }}" style="color:white;"><b></b></a>
        </div>
        <div class="container my-auto">
          <div class="form-row">
            <div class="col-md-12 offset">

                <div class="card card-default">
                    <div class="card-header">
                      {{-- <h3 class="card-title">
                        Permohonan Pendaftaran Anggota/Pengguna Sistem.
                      </h3> --}}
                      <h5>
                        <p class="card-title">Pendaftaran Pengguna</p>
                      </h5>
                    </div>
                    <!-- /.card-header -->

                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                PENDAFTARAN BERJAYA.
                            </div>
                        <!-- /.row6 -->
                        <a href="{{ route('login') }}" class="text-center">Log Masuk </a>
                        <!-- /.row6 -->

                        </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col (LEFT) -->


          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="{{ URL::asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ URL::asset('adminlte3/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{ URL::asset('adminlte3/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte3/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ URL::asset('adminlte3/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ URL::asset('adminlte3/dist/js/adminlte.js') }}"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#kategori_id').on('change.inputtentera', function() {
                $("#inputtentera").toggle($(this).val() == 'Tentera');
            }).trigger('change.inputtentera');
            $('#kategori_id').on('change.inputpangkat', function() {
                $("#inputpangkat").toggle($(this).val() == 'Tentera');
            }).trigger('change.inputpangkat');
        });
    </script>
    <script>
        //Initialize inputmask
        $('[data-mask]').inputmask()
    </script>
</body>
</html>



