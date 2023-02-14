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
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Projects</span>
                        <span class="info-box-number">{{ $user->projects->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tasks</span>
                        <span class="info-box-number">{{ $user->tasks->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Uploads</span>
                        <span class="info-box-number">13,648</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">93,139</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Project Status
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($user->projects as $project)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $project->name }}
                                @if ($project->status === 'in_progress')
                                    <span class="badge badge-primary">In Progress</span>
                                @elseif ($project->status === 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif ($project->status === 'onhold')
                                    <span class="badge badge-warning">On Hold</span>
                                @elseif ($project->status === 'cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @elseif ($project->status === 'overdue')
                                    <span class="badge badge-danger">Overdue</span>
                                @elseif ($project->status === 'upcoming')
                                    <span class="badge badge-info">Upcoming</span>
                                @else
                                    <span class="badge badge-secondary">{{ $project->status }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Task Status
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($user->tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $task->name }}
                                @if ($task->status === 'To Do')
                                    <span class="badge badge-primary">To Do</span>
                                @elseif ($task->status === 'In Progress')
                                    <span class="badge badge-warning">In Progress</span>
                                @elseif ($task->status === 'Completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif ($task->status === 'On Hold')
                                    <span class="badge badge-secondary">On Hold</span>
                                @elseif ($task->status === 'Cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @elseif ($task->status === 'Overdue')
                                    <span class="badge badge-danger">Overdue</span>
                                @else
                                    <span class="badge badge-secondary">{{ $task->status }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
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
