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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

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
                    <form method="POST" action="{{ route('newregister') }}">
                        @csrf
                        <div class="card-body">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    {{ $error }}
                                </div>
                            @endforeach
                            {{-- @error('name')
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    {{ $message }}
                                </div>
                            @enderror --}}
                            <!-- /.row1 -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori_id" style="width: 100%"
                                            id="kategori_id" required>
                                            <option disabled selected value> -- Pilih Kategori -- </option>
                                            <option value="Tentera"
                                                {{ old('kategori_id') == 'Tentera' ? 'selected' : '' }}>Tentera
                                            </option>
                                            <option value="Staf"
                                                {{ old('kategori_id') == 'Staf' ? 'selected' : '' }}>Staf Awam</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No. Kad Pengenalan</label>
                                        <input type="tel" class="form-control" name="no_ic" id="no_ic"
                                            value="{{ old('no_ic') }}" placeholder="No. Kad Pengenalan"
                                            data-inputmask="'mask': ['999999-99-9999']" data-mask required>
                                    </div>
                                </div>
                                <div class="col-md-3" style="display:none" id="inputtentera">
                                    <div class="form-group">
                                        <label>No. Tentera</label>
                                        <input type="tel" class="form-control" name="no_tentera"
                                            value="{{ old('no_tentera') }}" max="8" id="no_tentera"
                                            placeholder="No. Tentera" data-inputmask="'mask': ['9999999']" data-mask>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display:none" id="inputpangkat">
                                    <div class="form-group">
                                        <label>Pangkat</label>
                                        <select class="form-control select2bs4 no-radius" name="pangkat_id"
                                            onchange="checkPangkat(this)" style="width: 100%" id="pangkat_id">
                                            <option disabled selected value> -- Pilih Pangkat -- </option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->id_pangkat }}"
                                                    {{ old('pangkat_id') == $p->id_pangkat ? 'selected' : '' }}>
                                                    {{ $p->pangkat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row1 -->

                            <!-- /.row2 -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama (seperti kad pengenalan)</label>
                                        <input type="text" style="text-transform: uppercase;" class="form-control"
                                            value="{{ old('name') }}" name="name" id="name"
                                            placeholder="ALI BIN ABU" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pasukan</label>
                                        <select class="form-control select2bs4 no-radius" name="pasukan_id"
                                            onchange="checkPasukan(this)" style="width: 100%" id="pasukan_id"
                                            required>
                                            <option disabled selected value> -- Pilih Pasukan -- </option>
                                            @foreach ($pasukan as $ps)
                                                <option value="{{ $ps->id }}"
                                                    {{ old('pasukan_id') == $ps->id ? 'selected' : '' }}>
                                                    {{ $ps->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row2 -->

                            <!-- /.row3 -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status Anggota</label>
                                        <select class="form-control" name="status_anggota" style="width: 100%"
                                            id="status_anggota" required>
                                            <option disabled selected value> -- Pilih Status Anggota -- </option>
                                            <option value="tetap"
                                                {{ old('status_anggota') == 'tetap' ? 'selected' : '' }}>Tetap</option>
                                            <option value="sukarela"
                                                {{ old('status_anggota') == 'sukarela' ? 'selected' : '' }}>Sukarela
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bangsa</label>
                                        <select class="form-control select2bs4 no-radius" name="bangsa_id"
                                            style="width: 100%" id="bangsa_id" required>
                                            <option disabled selected value> -- Pilih Bangsa -- </option>
                                            <option value="Melayu"
                                                {{ old('bangsa_id') == 'Melayu' ? 'selected' : '' }}>Melayu</option>
                                            <option value="Cina" {{ old('bangsa_id') == 'Cina' ? 'selected' : '' }}>
                                                Cina</option>
                                            <option value="India"
                                                {{ old('bangsa_id') == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="Bumiputera"
                                                {{ old('bangsa_id') == 'Bumiputera' ? 'selected' : '' }}>Bumiputera
                                            </option>
                                            <option value="Lain-lain"
                                                {{ old('bangsa_id') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Telefon</label>
                                        <div class="input-group">
                                            {{-- <div class="input-group-prepend">
                                            <span class="input-group-text">+60</i></span>
                                        </div> --}}
                                            <input type="text" name="no_phone" id="no_phone"
                                                value="{{ old('no_phone') }}" class="form-control"
                                                data-inputmask="'mask': ['999-999-9999', '999-9999-9999']" data-mask
                                                required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <!-- /.col -->

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Tarikh Lahir</label>
                                        <input type="date" class="form-control" name="t_lahir"
                                            value="{{ old('t_lahir') }}" id="t_lahir" max="2010-01-01"
                                            placeholder="Tarikh lahir" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select class="form-control select2bs4 no-radius" name="agama_id"
                                            onchange="checkAgama(this)" style="width: 100%" id="agama_id" required>
                                            <option disabled selected value> -- Pilih Agama -- </option>
                                            @foreach ($agama as $ag)
                                                <option value="{{ $ag->idAgama }}"
                                                    {{ old('agama_id') == $ag->idAgama ? 'selected' : '' }}>
                                                    {{ $ag->agama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mel</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="text" name="email"
                                                value="{{ old('email') }}" id="email"
                                                class="form-control input-lg" placeholder="Ali@army.mil.my"
                                                name="name" required />
                                            {{-- <div class="input-group-append">
                                             <span class="input-group-text">@army.mil.my</span>
                                         </div> --}}
                                        </div>
                                        {{-- <label>E-mel</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Abu@army.mil.my" required> --}}
                                    </div>

                                </div>
                                <!-- /.col -->

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <select class="form-control select2bs4 no-radius" name="jawatan_id"
                                            onchange="checkJawatan(this)" style="width: 100%" id="jawatan_id"
                                            required>
                                            <option disabled selected value> -- Pilih Jawatan -- </option>
                                            @foreach ($jawatan as $jaw)
                                                <option value="{{ $jaw->id }}"
                                                    {{ old('jawatan_id') == $jaw->id ? 'selected' : '' }}>
                                                    {{ $jaw->jawatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jantina</label>
                                        <select class="form-control" name="jantina" style="width: 100%"
                                            id="jantina" required>
                                            <option disabled selected value> -- Pilih Jantina -- </option>
                                            <option value="Lelaki" {{ old('jantina') == 'Lelaki' ? 'selected' : '' }}>
                                                Lelaki</option>
                                            <option value="Perempuan"
                                                {{ old('jantina') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status Perkahwinan</label>
                                        <select class="form-control select2bs4 no-radius" name="s_kahwin"
                                            onchange="checkTarafkahwin(this)" style="width: 100%" id="s_kahwin"
                                            required>
                                            <option disabled selected value> -- Pilih Status Perkahwinan -- </option>
                                            @foreach ($taraf_kahwin as $tk)
                                                <option value="{{ $tk->idTarafKahwin }}"
                                                    {{ old('s_kahwin') == $tk->idTarafKahwin ? 'selected' : '' }}>
                                                    {{ $tk->tarafKahwin }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row3 -->

                            <!-- /.row4 -->
                            <div class="border border-dark">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kata Laluan</label>
                                            <input type="password" class="form-control" name="password"
                                                id="password" placeholder="Kata Laluan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pengesahan Kata Laluan</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Pengesahan Kata Laluan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row4 -->
                            <br />
                            <!-- /.row5 -->
                            <div class="row">
                                <button type="button" id="submitBtn" class="btn btn-info btn-block"
                                    data-toggle="modal" data-target="#modal-sm">
                                    Semak
                                </button>
                                {{-- <button type="submit" class="btn btn-info btn-block">Hantar</button> --}}
                            </div>
                            <!-- /.row5 -->
                            <hr />
                            <!-- /.row6 -->
                            {{-- <a href="{{ route('password.request') }}">Lupa Kata Laluan? </a> --}}
                            <a href="{{ route('login') }}" class="text-center">Log Masuk </a>
                            <!-- /.row6 -->
                        </div>

                        <div class="modal fade" id="modal-sm">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Semakan Pendaftaran Pengguna</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Pastikan semua ruangan diisi.</p>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Kategori</th>
                                                <td id="confirmkategori_id"></td>
                                            </tr>
                                            <tr>
                                                <th>No. Kad Pengenalan</th>
                                                <td id="confirmno_ic"></td>
                                            </tr>
                                            <tr id="confirminputtentera" style="display: none;">
                                                <th>No. Tentera</th>
                                                <td id="confirmno_tentera"></td>
                                            </tr>
                                            <tr id="confirminputpangkat" style="display: none;">
                                                <th>Pangkat</th>
                                                <td id="confirmpangkat_id"></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td id="confirmName"></td>
                                            </tr>
                                            <tr>
                                                <th>Pasukan</th>
                                                <td id="confirmpasukan_id"></td>
                                            </tr>
                                            <tr>
                                                <th>Status Anggota</th>
                                                <td id="confirmstatus_anggota"></td>
                                            </tr>
                                            <tr>
                                                <th>Bangsa</th>
                                                <td id="confirmbangsa_id"></td>
                                            </tr>
                                            <tr>
                                                <th>No. Telefon</th>
                                                <td id="confirmno_phone">+60</td>
                                            </tr>
                                            <tr>
                                                <th>Tarikh Lahir</th>
                                                <td id="confirmt_lahir"></td>
                                            </tr>
                                            <tr>
                                                <th>Agama</th>
                                                <td id="confirmagama_id"></td>
                                            </tr>
                                            <tr>
                                                <th>E-mel</th>
                                                <td id="confirmemail"></td>
                                            </tr>
                                            <tr>
                                                <th>Jawatan</th>
                                                <td id="confirmjawatan_id"></td>
                                            </tr>
                                            <tr>
                                                <th>Jantina</th>
                                                <td id="confirmjantina"></td>
                                            </tr>
                                            <tr>
                                                <th>Status Perkahwinan</th>
                                                <td id="confirms_kahwin"></td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Cancel</button>

                                        <button type="submit" class="btn btn-info">Hantar</button>

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </form>
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
    <script src="{{ URL::asset('adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}">
    </script>
    <!-- InputMask -->
    <script src="{{ URL::asset('adminlte3/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte3/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ URL::asset('adminlte3/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ URL::asset('adminlte3/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL::asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

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
            $('#kategori_id').on('change.confirminputtentera', function() {
                $("#confirminputtentera").toggle($(this).val() == 'Tentera');
            }).trigger('change.confirminputtentera');
            $('#kategori_id').on('change.confirminputpangkat', function() {
                $("#confirminputpangkat").toggle($(this).val() == 'Tentera');
            }).trigger('change.confirminputpangkat');
        });
    </script>
    <script>
        //Initialize inputmask
        $('[data-mask]').inputmask()
    </script>
    <script>
        var pangkatfirstload = document.getElementById("pangkat_id");
        var pasukanfirstload = document.getElementById("pasukan_id");
        var jawatanfirstload = document.getElementById("jawatan_id");
        var tarafkahwinfirstload = document.getElementById("s_kahwin");
        var agamanamefirstload = document.getElementById("agama_id");

        var pangkatname = pangkatfirstload.options[pangkatfirstload.selectedIndex].text;
        var pasukanname = pasukanfirstload.options[pasukanfirstload.selectedIndex].text;
        var jawatanname = jawatanfirstload.options[jawatanfirstload.selectedIndex].text;
        var tarafkahwin = tarafkahwinfirstload.options[tarafkahwinfirstload.selectedIndex].text;
        var agamaname = agamanamefirstload.options[agamanamefirstload.selectedIndex].text;

        function checkPangkat(evt) {
            // alert(evt.options[evt.selectedIndex].text);
            pangkatname = evt.options[evt.selectedIndex].text;
        }

        function checkPasukan(evt) {
            // pasukanname = evt.target.value;
            pasukanname = evt.options[evt.selectedIndex].text;
        }

        function checkAgama(evt) {
            //agamaname = evt.target.value;
            agamaname = evt.options[evt.selectedIndex].text;
        }

        function checkTarafkahwin(evt) {
            //tarafkahwin = evt.target.value;
            tarafkahwin = evt.options[evt.selectedIndex].text;
        }

        function checkJawatan(evt) {
            //jawatanname = evt.target.value;
            jawatanname = evt.options[evt.selectedIndex].text;
        }

        $('#submitBtn').click(function() {

            $('#confirmkategori_id').text($('#kategori_id').val());
            $('#confirmName').text($('#name').val().toUpperCase());
            $('#confirmno_tentera').text($('#no_tentera').val());
            $('#confirmno_ic').text($('#no_ic').val());
            $('#confirmpasukan_id').text(pasukanname);
            $('#confirmpangkat_id').text(pangkatname);

            $('#confirmkategori_id').text($('#kategori_id').val());
            $('#confirmstatus_anggota').text($('#status_anggota').val());
            $('#confirmbangsa_id').text($('#bangsa_id').val());
            $('#confirmno_phone').text($('#no_phone').val());
            $('#confirmt_lahir').text($('#t_lahir').val());
            $('#confirmagama_id').text(agamaname);
            $('#confirmemail').text($('#email').val());
            $('#confirmjawatan_id').text(jawatanname);
            $('#confirmjantina').text($('#jantina').val());
            $('#confirms_kahwin').text(tarafkahwin);

            // $('#confirmDescription').text($('#description').val());
            // $('#confirmSubject').text($('#subject').val());
            // $('#confirmAgency').text($('#agency').val());
            // $('#confirmFile').text($('#fileprove').val());
        });
    </script>
</body>

</html>
