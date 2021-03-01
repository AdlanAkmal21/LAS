@extends('layouts.wrapper')
@section('content')

<div class="card my-3">
    <div class="card-header"><b>{{ __('Notifications') }}</b>
    </div>
    <div class="card-body">

        @if ($notifications->isEmpty())
        <span class="text-muted">No Notifications Available</span>
        @else

        <ul class="list-group">

            <form action="{{ route('user.clear_notifications')}}" method="post">
                @csrf
                <input role="button" class="btn btn-primary" type="submit" value="Clear Notifications">
            </form>
            <br>

            @foreach ($notifications as $notification)
            <li class="list-group-item">
                @if ($notification->type == 'App\Notifications\NewApplicationAlert')
                <div class="row">
                    @if ($notification->data['leave_type'] == 2)
                    <div class="col-xl-9 col-lg-9">
                        <p>You have a new <strong>Medical Leave</strong> application from
                            <strong>{{ $notification->data['applicant_name']}}</strong>
                        </p>
                        <p><small>Applied at: <u>{{$notification->data['created_at']}}</u></small></p>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <a href="{{ route('approver.approver_list', Auth::id()) }}" class="btn btn-warning btn-block">Go
                            to
                            approver's list</a><br>
                    </div>
                    @else
                    <div class="col-xl-9 col-lg-9">
                        <p>You have a new leave application from
                            <strong>{{ $notification->data['applicant_name']}}</strong>
                        </p>
                        <p><small>Applied at: <u>{{$notification->data['created_at']}}</u></small></p>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <a href="{{ route('approver.approver_list', Auth::id()) }}" class="btn btn-info btn-block">Go to
                            approver's
                            list</a><br>
                    </div>
                    @endif
                </div>
                @elseif($notification->type == 'App\Notifications\ApproverAlert')
                <div class="row">
                    <div class="col-xl-9 col-lg-9">
                        <p>
                            Your leave application from {{$notification->data['from']}} to
                            {{ $notification->data['to'] }} has been
                            <strong>{{ $notification->data['status'] }}</strong>
                        </p>
                        <p>
                            <small>Approval at: <u>{{$notification->data['approval_date']}}</u></small>
                        </p>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <a href="{{ route('application.index')}}" class="btn btn-success btn-block">Go
                            to
                            application list</a><br>
                    </div>
                </div>
                @endif
            </li>
            @endforeach
        </ul>
        @endif

    </div>
    @if ($notifications->isNotEmpty())
    <div class="card-footer">
        {{$notifications->links()}}
    </div>
    @endif
</div>


@endsection
