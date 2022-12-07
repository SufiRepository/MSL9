@extends('layouts.defaultlayout')

@push('css')
@endpush
@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PROJECTS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active">PROJECTS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
        </div>
    @endif
    <!-- Main content -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projects</h3>

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
            <table id="projecttable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 20%">
                            Project Name
                        </th>
                        <th style="width: 30%">
                            Team Members
                        </th>
                        <th>
                            Project Progress
                        </th>
                        <th style="width: 8%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $key => $project)
                        <tr>
                            <td>
                                <a>
                                    {{ $project->name }}
                                </a>
                                {{-- <br />
                                <small>
                                    Created 01.01.2019
                                </small> --}}
                            </td>
                            <td>

                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                    </li>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                    </li>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">
                                    </li>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">
                                    </li>
                                </ul>
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                    </div>
                                </div>
                                <small>
                                    57% Complete
                                </small>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success"> {{ $project->status }}
                                </span>
                            </td>
                            <td class="project-actions text-right">
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-sm" href="{{ route('projects.show', $project->id) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('projects.edit', $project->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#DeleteAkaunCenter{{ $project->id }}" data-id="{{ $project->id }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#DeleteAkaunCenter{{ $project->id }}" data-id="{{ $project->id }}">
                                    </button> --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="DeleteAkaunCenter{{ $project->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Padam Kebenaran
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Sahkan padam kebenaran?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <img src="{{ url('/images/delete.png') }}" width="17"
                                                            height="17" alt="Image" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- /.content -->
    <script>
        $(function() {
            $('#projecttable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
