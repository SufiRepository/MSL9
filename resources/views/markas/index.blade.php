@extends('layouts.defaultlayout')


@section('content')
{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Pasukan</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('pasukan.create') }}"> Create New pasukan</a>
            @endcan
        </div>
    </div>
</div> --}}


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($markas as $key => $mks)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $mks->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('markas.show',$mks->id) }}">Show</a>
            @can('markas-edit')
                <a class="btn btn-primary" href="{{ route('markas.edit',$mks->id) }}">Edit</a>
            @endcan
            @can('markas-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['markas.destroy', $mks->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $markass->render() !!}


@endsection