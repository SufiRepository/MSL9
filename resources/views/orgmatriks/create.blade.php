@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">CIPTA ORGANISASI</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orgmatriks.index') }}">ORGANISASI</a></li>
                <li class="breadcrumb-item active">CIPTA ORGANISASI</li>
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
      <h3 class="card-title">Maklumat Organisasi </h3>
    </div>
    <form method="POST" action="/orgmatriks">
        @csrf
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pasukan</label>
                  <select class="form-control select2bs4 no-radius" name="pasukan_id"  style="width: 100%"   id="pasukan_id" required>
                    <option disabled selected value> -- Pilih Pasukan -- </option>
                    @foreach($pasukan as $ps)
                        <option value="{{ $ps->id }}">{{$ps->nama}}</option>
                    @endforeach
                </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Parent Pasukan</label>
                    <select class="form-control select2bs4 no-radius" name="parentId"  style="width: 100%"   id="parentId" >
                      <option disabled selected value> -- Pilih Pasukan -- </option>
                      @foreach($pasukan as $parent)
                          <option value="{{ $parent->id }}">{{$parent->nama}}</option>
                      @endforeach
                   </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Saluran</label>
                    <select class="form-control select2bs4 no-radius" name="saluran_id"  style="width: 100%"   id="saluran_id" required>
                      <option disabled selected value> -- Pilih Saluran -- </option>
                      @foreach($saluran as $sl)
                          <option value="{{ $sl->id }}">{{$sl->nama}}</option>
                      @endforeach
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>remark</label>
                  <input type="text"  style="text-transform: uppercase;" class="form-control" name="remark" id="name" placeholder="REMARK">
                </div>
              </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">HANTAR</button>
        </div>
    </form>
    <!-- /.card-header -->

  </div>
</div>
@endsection
