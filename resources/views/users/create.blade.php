@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Daftar Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active">Daftar</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

<div class="container-fluid">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Maklumat Pengguna baru</h3>
    </div>
    <form method="POST" action="/users">
        @csrf
        <div class="card-body">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    {{ $error }}
                </div>
            @endforeach


            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kategori</label>
                            <select class="form-control" name="kategori_id"  style="width: 100%"   id="kategori_id">
                              <option disabled selected value> -- Pilih Kategori -- </option>
                              <option  value="Tentera">Tentera</option>
                              <option  value="Staf">Staf Awam</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>No. Kad Pengenalan</label>
                        <input type="tel" class="form-control" name="no_ic" id="no_ic" placeholder="No. Kad Pengenalan" data-inputmask="'mask': ['999999-99-9999']" data-mask>
                    </div>
                </div>

                <div class="col-md-3" style="display:none" id="inputtentera">
                    <div class="form-group">
                        <label>No. Tentera</label>
                        <input type="number" class="form-control" name="no_tentera" id="no_tentera" placeholder="No. Tentera">
                    </div>
                </div>

                <div class="col-md-4" style="display:none" id="inputpangkat">
                    <div class="form-group">
                        <label>Pangkat</label>
                        <select class="form-control select2bs4 no-radius" name="pangkat_id"  style="width: 100%"   id="pangkat_id">
                            <option disabled selected value> -- Pilih Pangkat -- </option>
                            @foreach($pangkat as $p)
                                <option value="{{ $p->id_pangkat }}">{{$p->pangkat}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama (seperti kad pengenalan)</label>
                        <input type="text" style="text-transform: uppercase;" class="form-control" name="name" id="name" placeholder="ALI BIN ABU">
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pasukan</label>
                        <select class="form-control select2bs4 no-radius" name="pasukan_id"  style="width: 100%"   id="pasukan_id">
                            <option disabled selected value> -- Pilih Pasukan -- </option>
                            @foreach($pasukan as $ps)
                                <option value="{{ $ps->id }}">{{$ps->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- /.row3 -->
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Status Anggota</label>
                        <select class="form-control" name="status_anggota"  style="width: 100%"   id="status_anggota" >
                        <option disabled selected value> -- Pilih Status Anggota -- </option>
                        <option  value="tetap">Tetap</option>
                        <option  value="sukarela">Sukarela</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bangsa</label>
                        <select class="form-control select2bs4 no-radius" name="bangsa_id"  style="width: 100%"   id="bangsa_id" >
                            <option disabled selected value> -- Pilih Bangsa -- </option>
                            <option  value="Melayu">Melayu</option>
                            <option  value="Cina">Cina</option>
                            <option  value="India">India</option>
                            <option  value="Bumiputera">Bumiputera</option>
                            <option  value="Lain-lain">Lain-lain</option>
                    </select>
                  </div>

                  <!-- phone mask -->
                  <div class="form-group">
                        <label>No. Telefon</label>
                        <div class="input-group">
                        <input type="text" name="no_phone" class="form-control" data-inputmask="'mask': ['999-999-9999', '999-9999-9999']" data-mask>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">
                    <label>Tarikh Lahir</label>
                    <input type="date" class="form-control" name="t_lahir" id="t_lahir" max="2010-01-01" placeholder="Tarikh lahir" >
                  </div>
                  <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control select2bs4 no-radius" name="agama_id"  style="width: 100%"   id="agama_id" >
                        <option disabled selected value> -- Pilih Agama -- </option>
                        @foreach($agama as $ag)
                            <option value="{{ $ag->idAgama }}">{{$ag->agama}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>E-mel</label>
                    <div class="input-group">
                        <input autocomplete="off" type="text" name="email" id="email"  class="form-control input-lg" placeholder="Ali@army.mil.my" name="name"/>
                    </div>
                  </div>
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">
                    <label>Jawatan</label>
                    <select class="form-control select2bs4 no-radius" name="jawatan_id"  style="width: 100%"   id="jawatan_id">
                        <option disabled selected value> -- Pilih Jawatan -- </option>
                        @foreach($jawatan as $jaw)
                            <option value="{{ $jaw->id }}">{{$jaw->jawatan}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jantina</label>
                    <select class="form-control" name="jantina"  style="width: 100%"   id="jantina">
                        <option disabled selected value> -- Pilih Jantina -- </option>
                        <option  value="Lelaki">Lelaki</option>
                        <option  value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Perkahwinan</label>
                    <select class="form-control select2bs4 no-radius" name="s_kahwin"  style="width: 100%"   id="s_kahwin">
                        <option disabled selected value> -- Pilih Status Perkahwinan -- </option>
                        @foreach($taraf_kahwin as $tk)
                            <option value="{{ $tk->idTarafKahwin }}">{{$tk->tarafKahwin}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
            </div>

            <!-- /.row4 -->
            <div class="border border-dark">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kata Laluan</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Kata Laluan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pengesahan Kata Laluan</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Pengesahan Kata Laluan">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row4 -->
            <br>
            <!-- /.row5 -->
            <div class="border border-dark">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Peranan</label>
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Peranan" name="roles_id[]"  style="width: 100%"   id="roles_id" >
                                @foreach($roles as $rn)
                                    <option value="{{ $rn->name }}">{{$rn->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row5 -->
            <br>
            <!-- /.row6 -->
            <div class="border border-dark">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Akaun</label>
                            <select class="form-control" name="status_akaun"  style="width: 100%"   id="status_akaun">
                                <option disabled selected value> -- Pilih Status Akaun -- </option>
                                <option  value="Aktif">Aktif</option>
                                <option  value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row6 -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
    </form>
    <!-- /.card-header -->

  </div>
</div>
@endsection

@push('jscript')
<!-- InputMask -->
<script src="{{ URL::asset('adminlte3/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('adminlte3/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

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
@endpush
