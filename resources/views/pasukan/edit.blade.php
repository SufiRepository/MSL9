@extends('layouts.defaultlayout')



@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pasukan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                {{-- <li class="breadcrumb-item active"> <a href="{{ route('pasukan.show',$pasukan->id) }}">Pasukan</a></li> --}}
                <li class="breadcrumb-item active"> <a href="{{ route('pasukan.index') }}">Pasukan</a></li>
                <li class="breadcrumb-item"> Kemaskini</li>
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
    {!! Form::model($pasukan, ['method' => 'PATCH','route' => ['pasukan.update', $pasukan->id]]) !!}
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Maklumat Pasukan</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NAMA PASUKAN:</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="nama" id="nama"  value="{{$pasukan->nama}}" placeholder="NAMA PASUKAN" required>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>NAMA SINGKATAN</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="singkatan" id="singkatan" value="{{$pasukan->singkatan}}" placeholder="SINGKATAN PASUKAN" required>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>KOD PASUKAN</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_unit" id="kod_unit" value="{{$pasukan->kod_unit}}" placeholder="KOD PASUKAN">
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>NAMA KEM</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kem" id="kem" placeholder="NAMA KEM" value="{{$pasukan->kem}}">
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>LOKASI </label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="lokasi" id="lokasi"  value="{{$pasukan->lokasi}}"  placeholder="LOKASI">
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>NEGERI</label>
                <select class="form-control select2bs4" name="negeri"  style="width: 100%"  required >
                  <option  value="" disabled selected> PILIH NEGERI</option>
                  <option  value="JOHOR DARUL TAKZIM"{{ $pasukan->negeri == "JOHOR DARUL TAKZIM" ? 'selected' : '' }}>JOHOR DARUL TAKZIM</option>
                  <option  value="KEDAH DARUL AMAN"{{ $pasukan->negeri == "KEDAH DARUL AMAN" ? 'selected' : '' }}>KEDAH DARUL AMAN </option>
                  <option  value="KELANTAN DARUL NAIM"{{ $pasukan->negeri == "KELANTAN DARUL NAIM" ? 'selected' : '' }}>KELANTAN DARUL NAIM </option>
                  <option  value="MELAKA"{{ $pasukan->negeri == "MELAKA" ? 'selected' : '' }}>MELAKA</option>
                  <option  value="NEGERI SEMBILAN DARUL KHUSUS"{{ $pasukan->negeri == "NEGERI SEMBILAN DARUL KHUSUS" ? 'selected' : '' }}>NEGERI SEMBILAN DARUL KHUSUS </option>
                  <option  value="PAHANG DARUL MAKMUR"{{ $pasukan->negeri == "PAHANG DARUL MAKMUR" ? 'selected' : '' }}>PAHANG DARUL MAKMUR</option>
                  <option  value="PERAK DARUL RIDZUAN"{{ $pasukan->negeri == "PERAK DARUL RIDZUAN" ? 'selected' : '' }}>PERAK DARUL RADZUAN</option>
                  <option  value="PERLIS"{{ $pasukan->negeri == "PERLIS" ? 'selected' : '' }}>PERLIS</option>
                  <option  value="PULAU PINANG PULAU MUTIARA"{{ $pasukan->negeri == "PULAU PINANG PULAU MUTIARA" ? 'selected' : '' }}>PULAU PINANG PULAU MUTIARA</option>
                  <option  value="SELANGOR DARUL EHSAN"{{ $pasukan->negeri == "SELANGOR DARUL EHSAN" ? 'selected' : '' }}>SELANGOR DARUL EHSAN</option>
                  <option  value="TERENGGANU DARUL IMAN"{{ $pasukan->negeri == "TERENGGANU DARUL IMAN" ? 'selected' : '' }}>TERENGGANU DARUL IMAN</option>
                  <option  value="SABAH"{{ $pasukan->negeri == "SABAH" ? 'selected' : '' }}>SABAH</option>
                  <option  value="SARAWAK"{{ $pasukan->negeri == "SARAWAK" ? 'selected' : '' }}>SARAWAK</option>
                  <option  value="WILAYAH PERSEKUTUAN KUALA LUMPUR"{{ $pasukan->negeri == "WILAYAH PERSEKUTUAN KUALA LUMPUR" ? 'selected' : '' }}>WILAYAH PERSEKUTUAN KUALA LUMPUR</option>
                  <option  value="WILAYAH PERSEKUTUAN LABUAN"{{ $pasukan->negeri == "WILAYAH PERSEKUTUAN LABUAN" ? 'selected' : '' }}>WILAYAH PERSEKUTUAN LABUAN</option>
                  <option  value="WILAYAH PERSEKUTUAN PUTRAJAYA"{{ $pasukan->negeri == "WILAYAH PERSEKUTUAN PUTRAJAYA" ? 'selected' : '' }}>WILAYAH PERSEKUTUAN PUTRAJAYA</option>
              </select>
            </div>

          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>KOD EMERYS</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_emerys" placeholder="KOD EMERYS" value="{{$pasukan->kod_emerys}}" >
            </div>

            <div class="form-group">
              <label>KOD SPAKE</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_spake"placeholder="KOD SPAKE" value="{{$pasukan->kod_spake}}">
            </div>

            <div class="form-group">
              <label>KOD AIMS</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_aims" placeholder="KOD AIMS" value="{{$pasukan->kod_aims}}">
            </div>

            <div class="form-group">
              <label>KOD SPATD</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_spatd"  placeholder="KOD SPATD" value="{{$pasukan->kod_spatd}}">
            </div>

            <div class="form-group">
              <label>KOD SUTERA</label>
              <input type="text"  style="text-transform: uppercase;" class="form-control" name="kod_sutera" placeholder="KOD SUTERA" value="{{$pasukan->kod_sutera}}">
            </div>

            <div class="form-group">
              <label>FLAGSHIP</label>
              <select class="form-control select2bs4" name="flagship"  style="width: 100%"  required>
                <option  value="" disabled selected> PILIH FLAGSHIP</option>
                <option  value="FORMASI"{{ $pasukan->flagship == "FORMASI" ? 'selected' : '' }}>FORMASI</option>
                <option  value="DIVISYEN"{{ $pasukan->flagship == "DIVISYEN" ? 'selected' : '' }}>DIVISYEN</option>
                <option  value="BRIGED"{{ $pasukan->flagship == "BRIGED" ? 'selected' : '' }}>BRIGED</option>
                <option  value="PASUKAN"{{ $pasukan->flagship == "PASUKAN" ? 'selected' : '' }}>PASUKAN</option>
            </select>
            </div>


          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button  class="btn btn-primary">SIMPAN</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection
