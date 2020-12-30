@extends('layouts.main')
@section('content')

<div id="wrapper">
    <!--Start Wrapper-->
    @include('partials._sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Content Wrapper -->
        <div id="content">
            <!-- Main Content -->
            @include('partials._topbar')
            <div class="container-fluid">
                <!-- Begin Page Content -->

                <div class="card my-3">
                    <div class="card-header"><b>{{ __('Notifications') }}</b>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
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
                                        <a href="{{ route('users.approverlist', Auth::id()) }}"
                                            class="btn btn-warning btn-block">Go to approver's list</a><br>
                                    </div>
                                    @else
                                    <div class="col-xl-9 col-lg-9">
                                        <p>You have a new leave application from
                                            <strong>{{ $notification->data['applicant_name']}}</strong>
                                        </p>
                                        <p><small>Applied at: <u>{{$notification->data['created_at']}}</u></small></p>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <a href="{{ route('users.approverlist', Auth::id()) }}"
                                            class="btn btn-info btn-block">Go to approver's list</a><br>
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
                                        <a href="{{ route('applications.list')}}" class="btn btn-success btn-block">Go
                                            to
                                            application list</a><br>
                                    </div>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{$notifications->links()}}
                    </div>
                </div>


            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
