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
                        <li class="breadcrumb-item active"> <a href="{{ route('pasukan.index') }}">Pasukan</a></li>
                        <li class="breadcrumb-item active">Daftar</li>
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

        <form method="POST" action="/pasukan">
            @csrf
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
                                <input type="text" style="text-transform: uppercase;" class="form-control" name="nama"
                                    id="nama" placeholder="NAMA PASUKAN" required>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>NAMA SINGKATAN</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="singkatan" id="singkatan" placeholder="SINGKATAN PASUKAN" required>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>KOD PASUKAN</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_unit" id="kod_unit" placeholder="KOD PASUKAN">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>NAMA KEM</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control" name="kem"
                                    id="kem" placeholder="NAMA KEM">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>LOKASI </label>
                                <input type="text" style="text-transform: uppercase;" class="form-control" name="lokasi"
                                    id="lokasi" placeholder="LOKASI">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>NEGERI</label>
                                <select class="form-control select2bs4" name="negeri" style="width: 100%">
                                    <option value="" disabled selected> PILIH NEGERI</option>
                                    <option value="JOHOR DARUL TAKZIM">JOHOR DARUL TAKZIM</option>
                                    <option value="KEDAH DARUL AMAN">KEDAH DARUL AMAN </option>
                                    <option value="KELANTAN DARUL NAIM">KELANTAN DARUL NAIM </option>
                                    <option value="MELAKA">MELAKA</option>
                                    <option value="NEGERI SEMBILAN DARUL KHUSUS">NEGERI SEMBILAN DARUL KHUSUS </option>
                                    <option value="PAHANG DARUL MAKMUR">PAHANG DARUL MAKMUR</option>
                                    <option value="PERAK DARUL RIDZUAN">PERAK DARUL RADZUAN</option>
                                    <option value="PERLIS">PERLIS</option>
                                    <option value="PULAU PINANG PULAU MUTIARA">PULAU PINANG PULAU MUTIARA</option>
                                    <option value="SELANGOR DARUL EHSAN">SELANGOR DARUL EHSAN</option>
                                    <option value="TERENGGANU DARUL IMAN">TERENGGANU DARUL IMAN</option>
                                    <option value="SABAH">SABAH</option>
                                    <option value="SARAWAK">SARAWAK</option>
                                    <option value="WILAYAH PERSEKUTUAN KUALA LUMPUR">WILAYAH PERSEKUTUAN KUALA LUMPUR
                                    </option>
                                    <option value="WILAYAH PERSEKUTUAN LABUAN">WILAYAH PERSEKUTUAN LABUAN</option>
                                    <option value="WILAYAH PERSEKUTUAN PUTRAJAYA">WILAYAH PERSEKUTUAN PUTRAJAYA</option>
                                    `
                                </select>
                            </div>


                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>KOD EMESYS</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_emerys" placeholder="KOD EMERYS">
                            </div>

                            <div class="form-group">
                                <label>KOD SPAKE</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_spake"placeholder="KOD SPAKE">
                            </div>

                            <div class="form-group">
                                <label>KOD AIMS</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_aims" placeholder="KOD AIMS">
                            </div>

                            <div class="form-group">
                                <label>KOD SPATD</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_spatd" placeholder="KOD SPATD ">
                            </div>

                            <div class="form-group">
                                <label>KOD SUTERA</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control"
                                    name="kod_sutera" placeholder="KOD SUTERA">
                            </div>

                            <div class="form-group">
                                <label>FLAGSHIP</label>
                                <select class="form-control select2bs4" name="flagship" style="width: 100%" required>
                                    <option value="" disabled selected> PILIH PERINGKAT</option>
                                    <option value="FORMASI">FORMASI</option>
                                    <option value="DIVISYEN">DIVISYEN</option>
                                    <option value="BRIGED">BRIGED</option>
                                    <option value="PASUKAN">PASUKAN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button class="btn btn-primary">Hantar</button>
                </div>
            </div>
        </form>
    </div>


@endsection
