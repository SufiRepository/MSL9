@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CREATE ROLE</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">ROLE</a></li>
                        <li class="breadcrumb-item active">CREATE</li>
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
                <h3 class="card-title">ROLE</h3>
            </div>
            <form method="POST" action="/roles">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NAME</label>
                                <input type="text" style="text-transform: uppercase;" class="form-control" name="name"
                                    id="name" placeholder="">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>PERMISSIONS</label>
                                <select class="select2" multiple="multiple" data-placeholder="SELECT PERMISSIONS"
                                    name="permission[]" style="width: 100%" id="permission">
                                    @foreach ($permission as $rn)
                                        <option value="{{ $rn->name }}">{{ $rn->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.row5 -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </form>
            <!-- /.card-header -->

        </div>
    </div>
@endsection
