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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
                    <a href="{{ route('admins.applicationlist') }}" class="btn btn-success btn-sm">To application
                        list</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="name">Employee Name</label>
                                    <input class="form-control" type="text" name="name" disabled
                                        value="{{$application->user->name}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="leave_type_id">Leave Type</label>
                                    <input class="form-control" type="text" name="leave_type_id" disabled
                                        value="{{$application->refLeaveType->leave_type_name}}">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="from">From</label>
                                    <input class="form-control" type="date" value="{{$application->from}}" disabled
                                        name="from" id="from">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="to">To</label>
                                    <input class="form-control" type="date" value="{{$application->to}}" disabled
                                        name="to" id="to">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="days_taken">Days Taken</label>
                                    <input class="form-control" type="text" value="{{$application->days_taken}}"
                                        disabled name="days_taken" id="days_taken">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="created_at">Applied At</label>
                                    <input class="form-control" type="text" value="{{$created_at}}" disabled
                                        name="created_at" id="created_at">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="approver_id">Approved By</label>
                                    <input class="form-control" type="text"
                                        value="@empty($application->user->employee->approver->name)None @else{{$application->user->employee->approver->name}}@endempty"
                                        disabled name="approver_id" id="approver_id">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="reason">Reason</label>
                                    <input class="form-control" type="text" value="{{$application->reason}}" disabled
                                        name="reason" id="reason">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label" for="reason">Approval Date:</label>
                            <input class="form-control" type="text" value="{{$application->approval_date}}" disabled
                                name="approval_date" id="approval_date">
                        </div>

                        <div class="form-group">
                            <label for="application_status_id">Application Status:</label>
                            <input type="text" class="form-control form-control-lg text-center" style="font-size: 32px;"
                                disabled name="application_status_id"
                                value="{{$application->refAppStatus->application_status_name}}">
                        </div>

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
