@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
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
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Senarai Pengguna</h3>
            {{-- <a class="btn btn-success btn-sm p-2" href="{{ route('users.create') }}">Daftar Pengguna Baru</a> --}}
            {{-- <ul class="p-2">
                <a class="btn btn-success" href="{{ route('users.create') }}">Daftar Pengguna</a>
            </ul> --}}
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link {{ Request::segment(3) == 'Semua' ? 'active' : '' }}"
                        data-toggle="tab" id="buttonSemua">Semua</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::segment(3) == 'Pendaftaran Baru' ? 'active' : '' }}"
                        data-toggle="tab" id="buttonPendaftaranBaru">Pendaftaran Baru</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::segment(3) == 'Active' ? 'active' : '' }}"
                        data-toggle="tab" id="buttonAktif">Active</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::segment(3) == 'Inactive' ? 'active' : '' }}"
                        data-toggle="tab" id="buttonTidakAktif">Inactive</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::segment(3) == 'Arkib' ? 'active' : '' }}"
                        data-toggle="tab" id="buttonArkib">Archive</a></li>
            </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pasukan</th>
                        <th>E-mel</th>
                        <th>Status Akaun</th>
                        <th>Roles</th>
                        <th>Login Akhir</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->pasukan_id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#StatusAkaunCenter{{ $user->id }}" data-id="{{ $user->id }}">
                                    <img src="{{ url('/images/edit.png') }}" width="17" height="17"
                                        alt="Image" />
                                </button> --}}
                                {{ $user->acc_status }}
                                <!-- Modal -->
                                <div class="modal fade" id="StatusAkaunCenter{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Status Akaun</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tukar status akaun?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <a type="button" class="btn btn-primary"
                                                    href="{{ route('editaktifakaun', ['id' => $user->id]) }}">Active</a>
                                                <a type="button" class="btn btn-warning"
                                                    href="{{ route('edittidakaktifakaun', ['id' => $user->id]) }}">Inactive</a>
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
                                    <a class="btn btn-info" href="{{ route('archiveshow', $user->id) }}">
                                        <img src="{{ url('/images/open.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </a>
                                    {{-- <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">
                                        <img src="{{ url('/images/edit.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </a> --}}
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#DeleteAkaunCenter{{ $user->id }}" data-id="{{ $user->id }}">
                                        <img src="{{ url('/images/delete.png') }}" width="17" height="17"
                                            alt="Image" />
                                    </button> --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="DeleteAkaunCenter{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Padam Akaun</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Sahkan padam akaun?
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
                $('#buttonArkib').click(function() {
                    // table.search("Tidak Aktif").draw();
                    location.href = '{{ url('/users/filter/Arkib') }}';
                });
                $('#buttonPendaftaranBaru').click(function() {
                    // table.search("Tidak Aktif").draw();
                    location.href = '{{ url('/users/filter/Pendaftaran Baru') }}';
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
