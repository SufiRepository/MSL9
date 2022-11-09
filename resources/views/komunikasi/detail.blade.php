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
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item"> <a href="{{ url()->previous() }}">{{ $previous }}</a></li>
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
            <h3 class="card-title" style="text-transform: uppercase;">SENARAI {{ $jenis }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>PASUKAN</th>
                        <th>JENIS</th>
                        <th>VARIAN</th>
                        <th>HAK</th>
                        <th>PEGANGAN</th>
                        @if ($status == 'BOLEH GUNA')
                            <th>BOLEH GUNA</th>
                        @else
                            <th>TIDAK BOLEH GUNA</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @if ($status == 'BOLEH GUNA')
                        @foreach ($data as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $detail->namapasukan }}</td>
                                <td>{{ $detail->JENIS }}</td>
                                <td>{{ $detail->KATEGORI_UTAMA }}</td>
                                <td>{{ $detail->HAK }}</td>
                                <td>{{ $detail->PEG }}</td>
                                <td>{{ $detail->BG }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($data as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $detail->namapasukan }}</td>
                                <td>{{ $detail->JENIS }}</td>
                                <td>{{ $detail->KATEGORI_UTAMA }}</td>
                                <td>{{ $detail->HAK }}</td>
                                <td>{{ $detail->PEG }}</td>
                                <td>{{ $detail->TBG }}</td>
                            </tr>
                        @endforeach
                    @endif


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
