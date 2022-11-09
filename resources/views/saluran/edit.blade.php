@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Kemaskini Saluran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('saluran.index') }}">Saluran</a></li>
                <li class="breadcrumb-item active">Kemaskini Saluran</li>
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
      <h3 class="card-title">Maklumat Saluran</h3>
    </div>
    <form method="POST" action="/saluran/{{ $saluran->id }}">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>SALURAN</label>
                  <input type="text" class="form-control" style="text-transform: uppercase;" name="nama"  placeholder="NAMA SALURAN" value="{{$saluran->nama}}">
                </div>
                <!-- /.form-group -->
              </div>
            
              <div class="col-md-6">
                <div class="form-group">
                  <label>KOD SALURAN</label>
                  <input type="text" class="form-control" style="text-transform: uppercase;" name="kod_saluran"  placeholder="NAMA SALURAN" value="{{$saluran->kod_saluran}}">
                </div>
                <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Hantar</button>
        </div>
    </form>
    <!-- /.card-header -->

  </div>
</div>
@endsection
