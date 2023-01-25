@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                <h3 class="card-title">New Task</h3>
            </div>
            <form method="POST" action="/tasks">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task name</label>
                                <input type="text" class="form-control" name="taskname" id="taskname"
                                    placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task description</label>
                                <textarea type="text" class="form-control" name="taskdescription" id="taskdescription" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task status</label>
                                <input type="text" class="form-control" name="taskstatus" id="taskstatus"
                                    placeholder="Status">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Projects</label>
                        <select class="form-control custom-select" name="project_id" style="width: 100%" id="project_id">
                            <option selected disabled>Select one</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- /.card-header -->

        </div>
    </div>
@endsection
