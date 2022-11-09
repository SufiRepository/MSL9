@extends('layouts.defaultlayout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Pasukan </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('pasukan.index') }}"> Back</a>

            <a  href="{{route('markascreate', $pasukan->id)}}" class="btn btn-primary"> Create Pasukan </a>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $pasukan->name }}
        </div>
    </div>
</div>
<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>

    @foreach ($markas as $key => $mks)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $mks->name }}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('markas.show',$mks->id) }}">Show</a>
            @can('markas-edit')
                <a class="btn btn-primary" href="{{ route('markas.edit',$mks->id) }}">Edit</a>
            @endcan
            @can('markas-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['markas.destroy', $mks->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan --}}
        </td>
    </tr>
    @endforeach
</table>
@endsection