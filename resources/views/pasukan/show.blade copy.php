@extends('layouts.defaultlayout')

@push('css')
@endpush

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pasukan :  {{ $report}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pasukan.index') }}">pasukan</a></li>
                <li class="breadcrumb-item active"> {{ $report}}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> Senarai Pasukan</h3>
            <a class="btn btn-success " style=" margin-left:61%"   href="{{ route('pasukan.create') }}"> <i class="fas fa-plus fa-fw"></i>Pasukan</a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div id="treelist"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>


      
      <!-- /.col -->
      <div class="col-md-6">

        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">   {{ $report}}</h3>
              <div class="card-tools">
                <a class="btn btn-success "   href="{{ route('pasukan.edit',$pasukans->id) }}"> <i class="fas fa-wrench fa-fw"></i>Pasukan</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            @if($part == 'true')
          
                    <div class="card-body">
                        <!-- Color Picker -->
                        <div class="form-group">
                        <strong><i class="fas fa-book mr-1"></i>Singkatan</strong>
                        <p class="text-muted">{{$pasukans->singkatan}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Pasukan</strong>
                        <p class="text-muted"> {{$pasukans->kod_pasukan}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Lokasi</strong>
                        <p class="text-muted"> {{$pasukans->nama_kem}},{{$pasukans->lokasi}},{{$pasukans->negeri}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Emerys</strong>
                        <p class="text-muted"> {{$pasukans->kod_emerys}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Spake</strong>
                        <p class="text-muted"> {{$pasukans->kod_spake}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Aims</strong>
                        <p class="text-muted"> {{$pasukans->kod_aims}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Spatd</strong>
                        <p class="text-muted"> {{$pasukans->kod_spatd}} </p>
                        <strong><i class="fas fa-book mr-1"></i> Kod Sutera</strong>
                        <p class="text-muted"> {{$pasukans->kod_sutera}} </p>
                    
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- /.card-body -->   
            @endif
            </div>
            <!-- /.card-body -->
          </div>
      </div>
      <div class="col-md-6">
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        
      </div>
      
    </div>
    <!-- /.row -->



  </div><!-- /.container-fluid -->

@endsection

@push('jscript')
<script>
  var datajsonpasukan = @json($arraypasukans);

    $("#treelist").kendoTreeList({
      columns: [
        { field: "nama" },
        { command: [
        {
          name: "details",
          text: "Details",
          click: function(e) {
            var tr = $(e.target).closest("tr");
            var data = this.dataItem(tr);
            // console.log("Details for: " + data.id);
            location.href='{{ url('pasukan') }}'+'/' +data.id;
          },
          imageClass: "k-i-info"
        },
      
      ]}
      ],
      dataSource: {
        data:  datajsonpasukan
          },
      editable: {
            move: {
                reorderable: true
            }
      }
    });

    // Get a reference to the kendo.ui.TreeList instance.
    var treelist = $("#treelist").data("kendoTreeList");

    // Use the expand method to expand the first row.
    treelist.expand($("#treelist tbody>tr:eq(0)"));
</script>
@endpush
