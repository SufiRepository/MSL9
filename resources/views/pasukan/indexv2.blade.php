@extends('layouts.defaultlayout')

@push('css')
@endpush

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pasukan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pasukan</li>
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
            <h3 class="card-title">Pasukan</h3>
            <a class="btn btn-success " style="margin-left:70%"   href="{{ route('pasukan.create') }}"> <i class="fas fa-plus fa-fw"></i>Pasukan</a>

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
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
                @if($part == 'all')
                    <!-- Color Picker -->
                    <div class="form-group">
                    <strong><i class="fas fa-book mr-1"></i>Singkatan</strong>
                    <p class="text-muted"> Maklumat Asas </p>
                    </div>
                    <!-- /.form group -->                
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
        { field: "NAMA" },
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
        // { name: "destroy" } // built-in "destroy" command
      ]}
      ],
      dataSource: {
        data:  datajsonpasukan
          },
          toolbar: [ "save" ],
      editable: {
            move: {
                reorderable: true,
            }
      }
    });

    // Get a reference to the kendo.ui.TreeList instance.
    var treelist = $("#treelist").data("kendoTreeList");

    // Use the expand method to expand the first row.
    treelist.expand($("#treelist tbody>tr:eq(0)"));
</script>
@endpush
