@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <a class="btn btn-success" href="{{ route('users.create') }}">Create User</a>

                <button class="btn btn-primary">Import CSV Users</button>
                <a class="btn btn-success" href="{{ route('export-users') }}">Export CSV Users</a>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Last Login</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#StatusAkaunCenter{{ $user->id }}" data-id="{{ $user->id }}">
                                    <img src="{{ url('/images/edit.png') }}" width="17" height="17"
                                        alt="Image" />
                                </button>
                                {{ $user->acc_status }}
                                <!-- Modal -->
                                <div class="modal fade" id="StatusAkaunCenter{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Account Status</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Change account status?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-primary"
                                                    href="{{ route('editaktifakaun', ['id' => $user->id]) }}">Activate</a>
                                                <a type="button" class="btn btn-warning"
                                                    href="{{ route('edittidakaktifakaun', ['id' => $user->id]) }}">
                                                    Deactivate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->last_login)->format('j F, Y') }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">
                                        <img src="{{ url('/images/open.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">
                                        <img src="{{ url('/images/edit.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#DeleteAkaunCenter{{ $user->id }}" data-id="{{ $user->id }}">
                                        <img src="{{ url('/images/delete.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="DeleteAkaunCenter{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Account
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Confirm account deletion?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
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

    <script>
        $(function() {
            // Initialize the DataTable
            $(document).ready(function() {
                var table = $('#example1').DataTable({
                    // Enable the searching
                    // of the DataTable
                    "lengthChange": false,
                    searching: true,
                    "search": {
                        "smart": false
                    }
                });
                // Apply a search to the second table for the demo
                $('#buttonPendaftaranBaru').click(function() {
                    // table.search("Tidak Aktif").draw();
                    location.href = '{{ url('/users/filter/Pendaftaran Baru') }}';
                });
                $('#buttonArkib').click(function() {
                    // table.search("Tidak Aktif").draw();
                    location.href = '{{ url('/users/filter/Arkib') }}';
                });
                $('#buttonTidakAktif').click(function() {
                    // table.search("Tidak Aktif").draw();
                    location.href = '{{ url('/users/filter/Tidak Aktif') }}';
                });
                $('#buttonAktif').click(function() {
                    // table.search("Aktif").draw();
                    location.href = '{{ url('/users/filter/Aktif') }}';
                });
                $('#buttonSemua').click(function() {
                    // table.search("").draw();
                    location.href = '{{ url('/users/filter/Semua') }}';
                });
            });


        });
    </script>
@endsection
