@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Create Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Maklumat Pengguna baru</h3>
    </div>
    <form method="POST" action="/users">
        @csrf
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label>No. Tentera/ Staff ID/ No Kad Pengenalan</label>
                  <input type="text" class="form-control" name="no_tentera" id="no_tentera" placeholder="No. Tentera/ Staff ID/ No Kad Pengenalan">
                </div>

                <div class="form-group">
                  <label>Emel</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Emel">
                </div>

                <div class="form-group">
                  <label>Tarikh lahir</label>
                  <input type="date" class="form-control" name="t_lahir" id="T_lahir" placeholder="Tarikh lahir">
                </div>

                <div class="form-group">
                  <label for="Jantina">Jantina : </label>
                  <input type="radio" id="lelaki" name="jantina" value="Lelaki">
                  <label for="lelaki">Lelaki</label>
                  <input type="radio" id="perempuan" name="jantina" value="Perempuan">
                  <label for="javascript">Perempuan</label>
                </div>


                <div class="form-group">
                  <label>No Telefon</label>
                  <input type="number" class="form-control" name="no_phone" id="no_phone" placeholder="No Telefon">
                </div>

                {{-- <div class="form-group">
                  <label>Akses Pengguna</label>
                  <select multiple class="form-control" name="roles[]" id="roles[]">
                      @foreach ($roles as $role)
                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endforeach
                  </select>
                 <br>
                  @foreach($roles as $role)
                  <label>{{ Form::checkbox('roles[]', $role->id, false, array('class' => 'name')) }}
                  {{ $role->name }}</label>
                  @endforeach
                </div> --}}

              </div>
              <!-- /.col -->
              <div class="col-md-6">


                {{-- <div class="form-group">
                  <label>Pasukan</label>
                  <select class="form-control" name="pasukan_id"  style="width: 100%"   id="selectsearch" >
                    <option  value="" disabled selected>Pasukan Utama</option>
                    @foreach ( $pasukans as $pasukan )
                    <option  value="{{$pasukan->id}}">{{$pasukan->nama}}</option>
                    @endforeach
                  </select>
                </div> --}}
                {{-- <div class="form-group">
                  <label>Pangkat</label>'
                  <select class="form-control" name="pangkat_id"  style="width: 100%"   id="selectsearch" >
                    <option  value="" disabled selected>Pangkat</option>
                    @foreach ( $pangkats as $pangkat )
                    <option  value="{{$pangkat->id}}">{{$pangkat->nama}}</option>
                    @endforeach
                  </select>
                </div> --}}

                {{-- <div class="form-group">
                  <label>Jawatan</label>
                  <select class="form-control" name="jawatan_id"  style="width: 100%"   id="selectsearch" >
                    <option  value="" disabled selected>Pangkat</option>
                    @foreach ( $jawatans as $jawatan)
                    <option  value="{{$jawatan->id}}">{{$jawatan->nama}}</option>
                    @endforeach
                  </select>
                </div> --}}

                {{-- <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status_id"  style="width: 100%"   id="selectsearch" >
                    <option  value="" disabled selected>Status</option>
                    @foreach ( $status as $statusUser )
                    <option  value="{{$statusUser->id}}">{{$statusUser->nama}}</option>
                    @endforeach
                  </select>
                </div> --}}
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori_id"  style="width: 100%"   id="kategori_id" required>
                      <option disabled selected value> -- Pilih Kategori -- </option>
                      <option  value="Tentera">Tentera</option>
                      <option  value="Staf">Staf Awam</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Katalaluan</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Katalaluan">
                </div>
                <div class="form-group">
                  <label>Confirm Katalaluan</label>
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Katalaluan">
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <!-- /.card-header -->

  </div>
</div>
@endsection
