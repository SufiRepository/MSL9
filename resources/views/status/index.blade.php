@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Status</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">status</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Senarai Status</h3>
    <a class="btn btn-success btn-sm"  href="{{ route('status.create') }}">Status Baru</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $status)
            <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $status->nama }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('status.show',$status->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('status.edit',$status->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['status.destroy', $status->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
            </td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
