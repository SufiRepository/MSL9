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
                        <li class="breadcrumb-item"><a href="{{ route('resources.index') }}">Resources</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <h3 class="card-title">Info</h3>
            </div>
            <form method="POST" action="/resources/{{ $resource->id }}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="resourcename" placeholder="Nama"
                                    value="{{ $resource->name }}">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="resourcedescription" placeholder="Nama"
                                    value="{{ $resource->description }}">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Project</label>
                                <select class="form-control" name="project_id" id="project_id">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ $resource->projects->pluck('id')->contains($project->id) ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <select class="form-control" name="project_id" style="width: 100%" id="status_akaun">
                                    @foreach ( as )
                                        
                                    @endforeach
                                    <option value="Active"{{ $profile->acc_status == 'Active' ? 'selected' : '' }}>
                                        Active</option>
                                
                                </select> --}}
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!-- /.row -->
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
