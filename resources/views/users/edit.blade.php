@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
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
                <h3 class="card-title">User</h3>
            </div>
            <form method="POST" action="/users/{{ $user->id }}">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" style="text-transform: uppercase;" value="{{ $profile->nama_penuh }}"
                                    class="form-control" name="name" id="name" placeholder="ALI BIN ABU">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <!-- phone mask -->
                            <div class="form-group">
                                <label>No. Telefon</label>
                                <div class="input-group">
                                    <input type="text" name="no_phone" value="{{ $profile->no_phone }}"
                                        class="form-control" data-inputmask="'mask': ['999-999-9999', '999-9999-9999']"
                                        data-mask>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tarikh Lahir</label>
                                <input type="date" class="form-control" value="{{ $profile->t_lahir }}" name="t_lahir"
                                    id="t_lahir" max="2010-01-01" placeholder="Tarikh lahir">
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E-mel</label>
                                <div class="input-group">
                                    <input autocomplete="off" type="text" value="{{ $profile->email }}" name="email"
                                        id="email" class="form-control input-lg" placeholder="Ali@army.mil.my"
                                        name="name" />
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row3 -->

                    <!-- /.row4 -->
                    <div class="border border-dark">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Kata Laluan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="Pengesahan Kata Laluan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row4 -->
                    <br>
                    <!-- /.row5 -->
                    <div class="border border-dark">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Peranan</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Pilih Peranan"
                                        name="roles_id[]" style="width: 100%" id="roles_id">
                                        @foreach ($roles as $rn)
                                            <option value="{{ $rn->name }}"
                                                @foreach ($myroles as $mr)
                                        {{ $mr == $rn->name ? 'selected' : '' }} @endforeach>
                                                {{ $rn->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row5 -->
                    <br>
                    <!-- /.row6 -->
                    <div class="border border-dark">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status Akaun</label>
                                    <select class="form-control" name="status_akaun" style="width: 100%" id="status_akaun">
                                        <option disabled selected value> -- Pilih Status Akaun -- </option>
                                        <option value="Active"{{ $profile->acc_status == 'Active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option
                                            value="Inactive"{{ $profile->acc_status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row6 -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- /.card-header -->
        </div>
    </div>

    <script>
        //Initialize inputmask
        $('[data-mask]').inputmask()
    </script>
@endsection

@push('jscript')
    <!-- InputMask -->
    <script src="{{ URL::asset('adminlte3/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('adminlte3/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endpush
