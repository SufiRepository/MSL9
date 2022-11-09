@extends('layouts.defaultlayout')


@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                 <h1 class="m-0">ORGANISASI PASUKAN</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">organisasi Pasukan</li>
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

@if ($message = Session::get('error'))
<div class="alert alert-danger">
  <p>{{ $message }}</p>
</div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

  <div class="card card-danger">
    <div class="card-header">
      <h3 class="card-title">SALURAN</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    
    <div class="card-body">
      <div class="row">
        <div class="col-5">
          <select class="form-control select2bs4 no-radius" name="saluran_id"  id="comboA" onchange="getComboA(this)"  style="width: 100%"  required>
            <option disabled selected value> -- Pilih Saluran -- </option>
            @foreach($saluran as $sl)
                <option value="{{ $sl->id }}">{{$sl->nama}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    
  </div>

  @push('jscript')
    <script>
    function getComboA(selectObject) {
  var saluran_id = selectObject.value;  
  location.href='{{ url('/orgchart/view/') }}'+'/' + saluran_id;

}

    </script>
  @endpush
@endsection
