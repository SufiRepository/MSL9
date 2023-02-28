@extends('layouts.defaultlayout')

@push('css')
    <style>
        .list-group {
            max-height: 500px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }
    </style>
@endpush
@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Notifications</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notifications</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @forelse($notifications as $notification)
                    <li class="list-group-item">
                        {{ $notification->data['message'] }}
                        <br>
                        @if (isset($notification->data['project_id']))
                            Project: {{ $projects->where('id', $notification->data['project_id'])->first()->name ?? 'N/A' }}
                            <br>
                        @endif
                        Updated at: {{ \Carbon\Carbon::parse($notification->data['updated_at'])->format('d-m-Y H:i:s') }}
                        <span
                            class="badge badge-{{ $notification->read_at ? 'secondary' : 'danger' }}">{{ $notification->read_at ? 'Read' : 'Unread' }}</span>
                        @if ($notification->read_at)
                            <form method="post" action="{{ route('notifications.deleteNotification', $notification->id) }}"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item">No notifications found.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
