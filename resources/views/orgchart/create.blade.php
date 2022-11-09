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
                <li class="breadcrumb-item active">Pasukan</li>
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
  {!! Form::open(array('route' => 'pasukan.store','method'=>'POST')) !!}
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
            <label>Nama Pasukan:</label>
            {!! Form::text('nama', null, array('placeholder' => 'Nama Pasukan','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Nama Singkatan</label>
            {!! Form::text('singkatan', null, array('placeholder' => 'Nama Singkatan','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Kod Pasukan</label>
            {!! Form::text('kod_pasukan', null, array('placeholder' => 'Kod Pasukan','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Nama Kem</label>
            {!! Form::text('nama_kem', null, array('placeholder' => 'Nama Kem','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Lokasi </label>
            {!! Form::text('lokasi', null, array('placeholder' => 'Lokasi','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Negeri</label>
            <select class="form-control select2bs4" name="negeri" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Kod Emerys</label>
            {!! Form::text('kod_emerys', null, array('placeholder' => 'Kod Emerys','class' => 'form-control')) !!}
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Kod Spake</label>
            {!! Form::text('kod_spake', null, array('placeholder' => 'Kod Spake','class' => 'form-control')) !!}
          </div>
             <!-- /.form-group -->
             <div class="form-group">
              <label>Kod Aims</label>
              {!! Form::text('kod_aims', null, array('placeholder' => 'Kod Aims','class' => 'form-control')) !!}
            </div>
             <!-- /.form-group -->
             <div class="form-group">
              <label>Kod Spatd</label>
              {!! Form::text('kod_spatd', null, array('placeholder' => 'Kod Spatd','class' => 'form-control')) !!}
            </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Kod Sutera</label>
                {!! Form::text('kod_sutera', null, array('placeholder' => 'Kod Sutera','class' => 'form-control')) !!}
              </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button  class="btn btn-primary">Submit</button>
    </div>
  </div>
  {!! Form::close() !!}
</div>


@endsection