@extends('layouts.defaultlayout')

@push('css')
@endpush

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pasukan Khas</h1>
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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Pasukan</h3>
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

        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">filter</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <input type="text" class="form-control" placeholder=".col-3">
              </div>
              <div class="col-4">
                <input type="text" class="form-control" placeholder=".col-4">
              </div>
              <div class="col-5">
                <input type="text" class="form-control" placeholder=".col-5">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="card">
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
  
              <div class="demo-section wide">
                <div id="chart"></div>
              </div>
            
            @if($part == 'true')
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Maklumat Pasukan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
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
            </div>    @endif
            

            <script>
              function createChart() {
                  $("#chart").kendoChart({
                      title: {
                          text: "World population by age group and sex"
                      },
                      legend: {
                          visible: false
                      },
                      seriesDefaults: {
                          type: "column"
                      },
                      series: [{
                          name: "0-19",
                          stack: "Female",
                          data: [854622, 925844, 984930, 1044982, 1100941, 1139797, 1172929, 1184435, 1184654]
                      }, {
                          name: "20-39",
                          stack: "Female",
                          data: [490550, 555695, 627763, 718568, 810169, 883051, 942151, 1001395, 1058439]
                      }, {
                          name: "40-64",
                          stack: "Female",
                          data: [379788, 411217, 447201, 484739, 395533, 435485, 499861, 569114, 655066]
                      }, {
                          name: "65-79",
                          stack: "Female",
                          data: [97894, 113287, 128808, 137459, 152171, 170262, 191015, 210767, 226956]
                      }, {
                          name: "80+",
                          stack: "Female",
                          data: [16358, 18576, 24586, 30352, 36724, 42939, 46413, 54984, 66029]
                      },
                     ],
                      seriesColors: ["#cd1533", "#d43851", "#dc5c71", "#e47f8f", "#eba1ad",
                                     "#009bd7", "#26aadd", "#4db9e3", "#73c8e9", "#99d7ef"],
                      valueAxis: {
                          labels: {
                              template: "#= kendo.format('{0:N0}', value / 1000) # M"
                          },
                          line: {
                              visible: false
                          }
                      },
                      categoryAxis: {
                          categories: [1970, 1975, 1980, 1985, 1990, 1995, 2000, 2005, 2010],
                          majorGridLines: {
                              visible: false
                          }
                      },
                      tooltip: {
                          visible: true,
                          template: "#= series.stack #s, age #= series.name #"
                      }
                  });
              }
      
              $(document).ready(createChart);
              $(document).bind("kendo:skinChange", createChart);
          </script>
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
            location.href='{{ url('/reports/view/pasukanviewreport') }}'+'/' +data.id;
          },
          imageClass: "k-i-info"
        },
      ]}
      ],
      dataSource: {
        data:  datajsonpasukan
          },
  
    });

    // Get a reference to the kendo.ui.TreeList instance.
    var treelist = $("#treelist").data("kendoTreeList");

    // Use the expand method to expand the first row.
    treelist.expand($("#treelist tbody>tr:eq(0)"));
</script>
@endpush
