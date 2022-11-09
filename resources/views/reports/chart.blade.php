@extends('layouts.defaultlayout')

@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Chart</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Chart</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
{{-- <a class="offline-button" href="../index.html">Back</a> --}}

<div id="example">
    <div class="demo-section wide">
        <div id="chart"></div>
    </div>
    <script>

        function fibonacciSequence(n) {
            var data = [1, 1];
            for (var i = 2; i < n; i++) {
                data.push(data[i - 1] + data[i - 2]);
            }
            return data;
        }

        function createChart() {
            $("#chart").kendoChart({
                title: {
                    text: "Fibonacci sequence"
                },
                series: [{
                    data: fibonacciSequence(39)
                }],
                tooltip: {
                    visible: true
                },
                valueAxis: {
                    type: "log",
                    minorGridLines: {
                        visible: true
                    }
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>
</div>

@endsection
