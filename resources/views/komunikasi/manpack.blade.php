@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="text-transform: uppercase;"> RADIO MAN PACK {{ $unit }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('komunikasi', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}">KOMUNIKASI</a>
                        </li>
                        <li class="breadcrumb-item active">RADIO MAN PACK </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
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
                            <select name="cars" id="Formasi" onchange="unit(this)" class="form-control select2bs4">
                                <option disabled selected value> --PILIH FORMASI-- </option>
                                @foreach ($formasi as $fs)
                                    <option value="{{ $fs->id }}">{{ $fs->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">DIVISYEN:</label>
                            <select name="cars" id="Divisyen" onchange="unit(this)" class="form-control select2bs4">

                                <option disabled selected value> --PILIH DIVISYEN-- </option>
                                @foreach ($divisyen as $ds)
                                    <option value="{{ $ds->id }}">{{ $ds->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">BRIGED:</label>
                            <select name="cars" id="Briged" onchange="unit(this)" class="form-control select2bs4">

                                <option disabled selected value> --PILIH BRIGED-- </option>
                                @foreach ($briged as $be)
                                    <option value="{{ $be->id }}">{{ $be->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cars">PASUKAN:</label>
                            <select name="cars" id="Pasukan" onchange="unit(this)" class="form-control select2bs4">
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

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"style="text-transform: uppercase;">STATUS BOLEH GUNA ASET {{ $unit }}
                    </h3>
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
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">STATUS TIDAK BOLEH GUNA ASET {{ $unit }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
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
        var pasukan_id = @json($pasukan_id);

        var data = dataBolehGuna;

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
                    let uri = e.category;
                    let encoded = btoa(uri);

                    location.href = '{{ url('/reports/view/SubkomunikasiBG/') }}' + '/' + encoded + '/' + pasukan_id + '/' + 'MANPACK';
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>
    <script>
        var dataTidakBolehGuna = @json($tidakboleh_guna);
        var pasukan_id = @json($pasukan_id);

        var data = dataTidakBolehGuna;

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
                    // console.log(e.category);
                    let uri = e.category;
                    let encoded = btoa(uri);
                    location.href = '{{ url('/reports/view/SubkomunikasiTBG/') }}' + '/' + encoded + '/' +  pasukan_id + '/' + 'MANPACK';
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>

    <script>
        function unit(selectObject) {
            var pasukan_id = selectObject.value;
            location.href = '{{ url('/reports/view/manpack/') }}' + '/' + pasukan_id;
        }
    </script>
@endsection
