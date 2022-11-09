@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="text-transform: uppercase;">SENARAI {{ $jenis }} {{ $status }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="text-transform: uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $previous }}</a></li>
                        <li class="breadcrumb-item active">{{ $status }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="text-transform: uppercase;"s>SENARAI {{ $jenis }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NO.SIRI</th>
                        <th>NAMA</th>
                        <th>VARIAN</th>
                        <th>SUB VARIAN</th>
                        <th>CATATAN</th>
                        <th>PASUKAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $detail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->PART_NO }}</td>
                            <td>{{ $detail->KATEGORI_UTAMA }}</td>
                            <td>{{ $detail->JENAMA }}</td>
                            <td>{{ $detail->SUBKATEGORI_ASET }}</td>
                            @if ($detail->CATATAN != NULL)
                            <td>{{ $detail->namapasukan }}</td>
                            @else
                            <td>-</td>
                            @endif
                            <td>{{ $detail->namapasukan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["csv", "pdf", ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
@endsection
