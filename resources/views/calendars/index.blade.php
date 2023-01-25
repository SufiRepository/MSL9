@extends('layouts.defaultlayout')

@push('css')
@endpush
@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CALENDARS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">HOME</a></li>
                        <li class="breadcrumb-item active">CALENDARS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
        </div>
    @endif
    <!-- Main content -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            {{-- <a class="btn btn-success btn-sm" href="{{ route('projects.create') }}">Create
                Projects</a> --}}

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id='calendar'></div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- /.content -->
    <script>
        var tasks = [{
                title: 'Task 1',
                start: '2023-01-01',
                end: '2023-01-21'
            },
            {
                title: 'Task 2',
                start: '2023-01-02',
                end: '2023-01-08'
            }
        ];

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // initialDate: '2023-02-12',
                nowIndicator: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: tasks,
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endsection
