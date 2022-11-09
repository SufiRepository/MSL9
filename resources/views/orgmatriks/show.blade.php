@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Maklumat Organisasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orgmatriks.index') }}">Organisasi</a></li>
                <li class="breadcrumb-item active">Maklumat</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
 <!-- Default box -->
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Maklumat Organisasi</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
          {{-- sebelah kiri --}}
          <div class="col-md-6">
                <div class="form-group">
                    <strong>NAMA:</strong>
                      {{ $pasukan->NAMA }}
                </div>
  
                <div class="form-group">
                    <strong>SINGKATAN:</strong>
                    {{ $pasukan->singkatan }}
                </div>
           
                <div class="form-group">
                  <strong>KOD PASUKAN:</strong>
                  {{ $pasukan->kod_unit }}
                </div>
  
                <div class="form-group">
                  <strong>NAMA KEM:</strong>
                  {{ $pasukan->kem }}
                </div>
  
                <div class="form-group">
                  <strong>LOKASI:</strong>
                  {{ $pasukan->lokasi }}
                </div>
  
                <div class="form-group">
                  <strong>NEGERI:</strong>
                  {{ $pasukan->negeri }}
                </div>
        </div>
         {{-- sebelah kanan --}}
        <div class="col-md-6">
            
                <div class="form-group">
                  <strong>KOD EMERYS:</strong>
                    {{ $pasukan->kod_emerys }}
              </div>
  
              <div class="form-group">
                  <strong>KOD SPAKE:</strong>
                  {{ $pasukan->kod_spake}}
              </div>
        
              <div class="form-group">
                <strong>KOD AIMS:</strong>
                {{ $pasukan->kod_aims }}
              </div>
  
              <div class="form-group">
                <strong>KOD SPATD:</strong>
                {{ $pasukan->kod_spatd }}
              </div>
  
              <div class="form-group">
                <strong>KOD SUTERA:</strong>
                {{ $pasukan->kod_sutera }}
              </div>
  
              <div class="form-group">
                <strong>FLAGSHIP:</strong>
                {{ $pasukan->flagship }}
              </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
@endsection
