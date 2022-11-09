@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="text-transform: uppercase;">ASET ARTILERI {{ $unit }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('carianutama', ['id' => $caripasukan->id]) }}">UTAMA</a></li>
                        <li class="breadcrumb-item active">ASET ARTILERI </li>
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
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        {{-- <img src="{{url('images/truck.png')}}" class="float-right" height="50%" width="25%"> --}}
                        <h3>{{ number_format($count_medan) }}</h3>
                        <p>MEDAN </p>
                    </div>
                    <a href="{{ route('medan', ['id' => $caripasukan->id]) }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- <img src="{{url('images/senjata.png')}}" class="float-right" height="50%" width="25%"> --}}
                        <h3>{{ number_format($count_udara) }}</h3>
                        <p>PERTAHANAN UDARA</p>
                    </div>
                    <a href="{{ route('pertahananudara', ['id' => $caripasukan->id]) }}" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">CARIAN</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="cars">FORMASI:</label>
                            <select name="Formasi" id="Formasi" onchange="unit(this)" class="form-control select2bs4">
                                <option disabled selected value> --PILIH FORMASI-- </option>
                                @foreach ($formasi as $fs)
                                    <option value="{{ $fs->id }}">{{ $fs->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">DIYISYEN:</label>
                            <select name="Divisyen" id="Divisyen" onchange="unit(this)"class="form-control select2bs4">
                                <option disabled selected value> --PILIH DIYISYEN-- </option>
                                @foreach ($divisyen as $ds)
                                    <option value="{{ $ds->id }}">{{ $ds->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">BRIGED:</label>
                            <select name="Briged" id="Briged" onchange="unit(this)" class="form-control select2bs4">
                                <option disabled selected value> --PILIH BRIGED-- </option>
                                @foreach ($briged as $be)
                                    <option value="{{ $be->id }}">{{ $be->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">PASUKAN:</label>
                            <select name="Pasukan" id="Pasukan" onchange="unit(this)" class="form-control select2bs4">
                                <option disabled selected value> --PILIH PASUKAN-- </option>
                                @foreach ($pasukan as $pk)
                                    <option value="{{ $pk->id }}">{{ $pk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">

            <div class="card  card-info">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: uppercase;">KEUPAYAAN DAN KESIAGAAN {{ $unit }}
                    </h3>
                </div>
                <div class="card-body">

                    @if ($tiadadata == 0)
                        <div id="barchart" style="background: center no-repeat"></div>
                    @else
                        {{ $tiadadata }}
                    @endif

                </div>
            </div>


            <div class="card  card-success ">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: uppercase;">STATUS  BOLEH GUNA ASET
                        {{ $unit }}</h3>
                </div>
                <div class="card-body">
                    @if ($bolehgunatiadadata == 0)
                        <div id="chart" style="background: center no-repeat"></div>
                    @else
                        {{ $bolehgunatiadadata }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card  card-warning">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: uppercase;">KEUPAYAAN DAN KESIAGAAN KESELURUHAN
                        {{ $unit }}</h3>
                </div>
                <div class="card-body ">
                    @if ($tiadadata == 0)
                        <div style="height: 400px">
                            <table id="example1" class="table table-bordered table-striped;">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>KATEGORI ASET</th>
                                        <th>HAK</th>
                                        <th>PEGANGAN</th>
                                        <th>BOLEH GUNA</th>
                                        <th>TIDAK BOLEH GUNA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hak as $key => $detail)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $detail->jenis }}</td>
                                            <td>{{ $detail->hak }}</td>
                                            <td>{{ $detail->pegangan }}</td>
                                            <td>{{ $detail->BG }}</td>
                                            <td>{{ $detail->TBG }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{ $tiadadata }}
                    @endif


                </div>
            </div>

            <div class="card card-danger ">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: uppercase;">STATUS TIDAK BOLEH GUNA ASET
                        {{ $unit }}</h3>
                </div>
                <div class="card-body h-100">
                    @if ($tidakBolehtiadadata == 0)
                        <div id="charttidakbolehguna" style="background: center no-repeat ;"></div>
                    @else
                        {{ $tidakBolehtiadadata }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        var dataBolehGuna = @json($boleh_guna);

        var data = dataBolehGuna;
        var pasukan_id = @json($pasukan_id);

        function createChart() {
            $("#chart").kendoChart({
                title: {
                    // text: "Aset Boleh Guna"
                },
                legend: {
                    position: "bottom",
                    labels: {
                        font: "18px sans-serif",
                        color: "black"
                    },
                },
                dataSource: {
                    data: data
                },
                seriesDefaults: {
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: "#= category #: \n #= value#"
                    }
                },
                series: [{
                    type: "pie",
                    field: "percentage",
                    categoryField: "source",
                    explodeField: "explode"
                }],
                seriesColors: ["#4C7069", "#E5B276", "#767DE5", "#E576D4"],
                tooltip: {
                    visible: true,
                    template: "${ category } - ${ value }"
                },


                seriesClick: function(e) {
                    console.log(e.category);
                    location.href = '{{ url('/reports/view/bolehgunajenis/') }}' + '/' + e.category + '/' + pasukan_id+ '/' + 'ARTILERI';
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>
    <script>
        var dataTidakBolehGuna = @json($tidakboleh_guna);

        var data = dataTidakBolehGuna;
        var pasukan_id = @json($pasukan_id);

        function createChart() {
            $("#charttidakbolehguna").kendoChart({
                title: {
                    // text: "Aset Tidak Boleh Guna"
                },
                legend: {
                    position: "bottom",
                    labels: {
                        font: "18px sans-serif",
                        color: "black"
                    }
                },
                dataSource: {
                    data: data
                },
                seriesDefaults: {
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: "#= category #: \n #= value#"
                    }
                },
                series: [{
                    type: "pie",
                    field: "percentage",
                    categoryField: "source",
                    explodeField: "explode"
                }],
                seriesColors: ["#03a9f4", "#ff9800", "#fad84a", "#4caf50"],
                tooltip: {
                    visible: true,
                    template: "${ category } - ${ value }"
                },
                seriesClick: function(e) {
                    console.log(e.category);
                    location.href = '{{ url('/reports/view/tidakbolehgunajenis/') }}' + '/' + e.category + '/' + pasukan_id+ '/' + 'ARTILERI';
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>

    <script>
        var datanamauntukjenisbar = @json($namadalamarray);

        var datahak = @json($keupayaan);

        var datapeg = @json($kesiagaan);

        function createChart() {
            $("#barchart").kendoChart({
                title: {
                    text: ""
                },
                legend: {
                    position: "bottom",
                    visible: true,
                    labels: {
                        font: "18px sans-serif",
                        color: "black"
                    }
                },

                seriesDefaults: {
                    type: "column",
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: " #= value#%"
                    }
                },
                series: [{
                    name: "KEUPAYAAN",
                    stack: "KEUPAYAAN",
                    data: datahak
                }, {
                    name: "KESIAGAAN",
                    stack: "KESIAGAAN",
                    data: datapeg
                }, ],
                seriesColors: ["#cd1533", "#99d7ef"],
                valueAxis: {
                    labels: {
                        template: "#= kendo.format('{0:N0}', value) #%"
                    },
                    line: {
                        visible: false
                    }
                },
                categoryAxis: {
                    categories: datanamauntukjenisbar,
                    majorGridLines: {
                        visible: false
                    }
                },
                tooltip: {
                    visible: true,
                    template: "#= series.stack #"
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "buttons": ["csv", "pdf", ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        function unit(selectObject) {
            var pasukan_id = selectObject.value;
            // console.log("id" + pasukan_id)
            location.href = '{{ url('/reports/view/artileri/') }}' + '/' + pasukan_id;
        }
    </script>
@endsection
