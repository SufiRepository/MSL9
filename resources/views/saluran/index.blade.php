@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                 <h1 class="m-0">Saluran</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Saluran</li>
                  </ol>
              </div>
          </div>
        </div>
    </div>
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
    <h3 class="card-title">Senarai Saluran</h3>
    <a class="btn btn-success btn-sm"  href="{{ route('saluran.create') }}">Saluran Baru</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
      <tr>
        <th>NO.</th>
        <th>SALURAN</th>
        <th>KOD SALURAN</th>
        <th>TINDAKAN</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $user)
            <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->kod_saluran }}</td>
            <td>
                <form action="{{ route('saluran.destroy',$user->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('saluran.show',$user->id) }}">
                        <img src="{{url('/images/open.png')}}" width="17" height="17" alt="Image"/>
                    </a>
                    <a class="btn btn-primary" href="{{ route('saluran.edit',$user->id) }}">
                        <img src="{{url('/images/edit.png')}}" width="17" height="17" alt="Image"/>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteAkaunCenter{{ $user->id }}" data-id="{{ $user->id }}">
                        <img src="{{url('/images/delete.png')}}" width="17" height="17" alt="Image"/>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="DeleteAkaunCenter{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Padam Saluran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Sahkan padam Saluran?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">
                                <img src="{{url('/images/delete.png')}}" width="17" height="17" alt="Image"/>
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
