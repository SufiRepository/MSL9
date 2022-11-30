@extends('layouts.defaultlayout')

@push('css')
@endpush
@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DASHBOARD</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active">DASHBOARD</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
@endsection

@section('content')
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">

            </div>
            <!-- ./col -->
        </div>

    </div>
    <!-- /.content -->
@endsection
