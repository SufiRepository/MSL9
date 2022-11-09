@extends('layouts.defaultlayout')

@section('contentheader')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="text-transform: uppercase;">Asset Senjata {{ $unit }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('carianutama', ['id' => $caripasukan->id]) }}">UTAMA</a></li>
                        <li class="breadcrumb-item active"> ASET SENJATA</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"style="text-transform: uppercase;">ASET BOLEH GUNA {{ $unit }}
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
                    <h3 class="card-title" style="text-transform: uppercase;">ASET TIDAK BOLEH GUNA
                        {{ $unit }}</h3>
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

        var data = dataBolehGuna;
        var pasukan_id = @json($pasukan_id);

        function createChart() {
            $("#chart").kendoChart({
                title: {
                    // text: "Aset Boleh Guna"
                },
                legend: {
                    position: "bottom"
                },
                seriesDefaults: {
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: "#= category #: \n #= value#"
                    }
                },

                dataSource: {
                    data: data
                },
                series: [{
                    type: "pie",
                    field: "percentage",
                    categoryField: "source",
                    explodeField: "explode"
                }],
                seriesColors: ["#4caf19", "#4903fc", "#4caf20", "#03fca9", "#03dbfc"],
                tooltip: {
                    visible: true,
                    template: "${ category } - ${ value }"
                },
                seriesClick: function(e) {
                    console.log(e.category);
                    location.href = '{{ url('/reports/view/bolehgunasub/') }}' + '/' + e.category + '/' +pasukan_id+ '/' + 'SENJATA';
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>


    <script>
        var datatidakBolehGuna = @json($tidak_boleh_guna);

        var dataTBG = datatidakBolehGuna;
        var pasukan_id = @json($pasukan_id);

        function createChart() {
            $("#charttidakbolehguna").kendoChart({
                title: {
                    // text: "Aset Tidak Boleh Guna"
                },
                legend: {
                    position: "bottom"
                },
                dataSource: {
                    data: dataTBG
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
                seriesColors: ["#fc8403", "#fcba03", "#4c95af", "#fc038c", "#f2f20d", "#fcca03", "#fcf803",
                    "#fc0303"
                ],
                tooltip: {
                    visible: true,
                    template: "${ category } - ${ value }"
                },
                seriesClick: function(e) {
                    console.log(e.category);
                    location.href = '{{ url('/reports/view/tidakbolehgunasub/') }}' + '/' + e.category + '/' + pasukan_id+ '/' + 'SENJATA';
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
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "pdf", "print", "colvis"]
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

    <script>
        function unit(selectObject) {
            var pasukan_id = selectObject.value;
            location.href = '{{ url('/reports/view/senjata/') }}' + '/' + pasukan_id;
            // console.log("id pasukan + " +pasukan_id )
        }
    </script>
@endsection
