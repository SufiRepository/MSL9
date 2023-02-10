@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users CSV</h1>
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
            <a class="btn btn-success" href="{{ route('users.create') }}">Create User</a>
            <a class="btn btn-success" href="{{ route('export-users') }}">Export CSV Users</a>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <button class="btn btn-primary">Import CSV Users</button>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }}</td>
                            <td>{{ $row[2] }}</td>
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
