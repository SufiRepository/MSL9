@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <h3 class="card-title">Role</h3>
            </div>
            <form method="POST" action="/roles/{{ $role->id }}">
                @csrf
                @method('PATCH')
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
                                <label>NAMA</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $role->name }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label>Peranan</label>
                            <select class="select2" multiple="multiple" data-placeholder="Pilih Peranan" name="permission[]"
                                style="width: 100%" id="permission">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}"
                                        @if ($role->hasPermissionTo($permission->id)) selected="selected" @endif>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.row5 -->
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
