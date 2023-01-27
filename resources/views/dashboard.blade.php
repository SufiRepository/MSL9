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
            <div class="col-md-4">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <h5 class="widget-user-desc">WS Developer</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/projects') }}" class="nav-link">
                                    Projects <span
                                        class="float-right badge bg-primary">{{ $user->projects->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/tasks') }}" class="nav-link">
                                    Tasks <span class="float-right badge bg-info">{{ $user->tasks->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Completed Projects <span class="float-right badge bg-success">12</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Followers <span class="float-right badge bg-danger">842</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <!-- /.col -->

        </div>

    </div>
    <!-- /.content -->


    {{-- <script type="text/javascript">
        $(function() {
            $('#calendar').datetimepicker({
                format: 'L',
                inline: true
            })
        })
    </script> --}}
@endsection
