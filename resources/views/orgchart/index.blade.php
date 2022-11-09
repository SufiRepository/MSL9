@extends('layouts.defaultlayout')

@push('css')
@endpush

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pasukan Organization Chart</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pasukan Organization Chart</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">

            <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Pasukan Organization list
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="treelist"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col (LEFT) -->

        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Pasukan Chart
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('jscript')
<script>
    var mm = @json($pasukans);
    //console.log(mm);
    //trigger if
    function treelist_columnReorder(e) {
      console.log(e.column.field, e.newIndex, e.oldIndex);
    }
    function cancel(e) {
        console.log("cancel");
    }

    $("#treelist").kendoTreeList({
      columns: [
        { field: "nama" },
        { field: "nama_kem" }
      ],
      dataSource: {
        data : mm
        // data: [
        //   { id: 1, parentId: null, Name: "Jane Smith", Position: "CEO" },
        //   { id: 20, parentId: 1,    Name: "Alex Sells", Position: "EVP Sales" },
        //   { id: 21, parentId: 1,    Name: "Mia", Position: "EVP Sales" },
        //   { id: 22, parentId: 1,    Name: "Nether", Position: "EVP Sales" },
        //   { id: 23, parentId: 20,    Name: "Aluber", Position: "EVP Sales" },
        //   { id: 24, parentId: 21,    Name: "Ecclesia", Position: "EVP Sales" },
        //   { id: 25, parentId: 22,    Name: "John Wick", Position: "EVP Sales" },
        //   { id: 30, parentId: 25,    Name: "Bob Price",  Position: "EVP Marketing" }
        // ]
      },
      editable: {
            move: {
                reorderable: true
            }
      }
    });

    // Get a reference to the kendo.ui.TreeList instance.
    var treeList = $("#treelist").data("kendoTreeList");

    // Use the expand method to expand the first row.
    treeList.expand($("#treelist tbody>tr:eq(0)"));

    //
    treeList.bind("columnReorder", treelist_columnReorder);
    treeList.bind("cancel", cancel);

</script>
<script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
        },
    ]
    }

    var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
        display: false
    },
    scales: {
        xAxes: [{
        gridLines : {
            display : false,
        }
        }],
        yAxes: [{
        gridLines : {
            display : false,
        }
        }]
    }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
    type: 'line',
    data: areaChartData,
    options: areaChartOptions
    })


      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })
  </script>

@endpush
