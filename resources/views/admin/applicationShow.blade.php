@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
</div>

    <div class="card">
        <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="label" for="name">Employee Name</label>
                            <input class="form-control" type="text" name="name" disabled placeholder="{{$application->user->name}}">
                        </div> 
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="label" for="leave_type_id">Leave Type</label>
                            <input class="form-control" type="text" name="leave_type_id" disabled placeholder="{{$application->refLeaveType->leave_type_name}}">
                            </select>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                                <label class="label" for="from">From</label>
                        <input class="form-control" type="date" value="{{$application->from}}" disabled name="from" id="from">
                            </div>
                        </div>

                        <div class="col">
                        <div class="form-group">
                                <label class="label" for="to">To</label>
                                <input class="form-control" type="date" value="{{$application->to}}" disabled name="to" id="to">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="days_taken">Days Taken</label>
                                <input class="form-control" type="text" placeholder="{{$application->days_taken}}" disabled name="days_taken" id="days_taken">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="created_at">Applied At</label>
                                <input class="form-control" type="text" value="{{$created_at}}" disabled name="created_at" id="created_at">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="approver_id">Approved By</label>
                                <input class="form-control" type="text" placeholder="{{$application->user->employee->approver->name}}" disabled name="approver_id" id="approver_id">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="reason">Reason</label>
                                <input class="form-control" type="text" placeholder="{{$application->reason}}" disabled name="reason" id="reason">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="application_status_id">Application Status:</label>
                        <input type="text" class="form-control form-control-lg text-center" style="font-size: 32px;" disabled name="application_status_id" placeholder="{{$application->refAppStatus->application_status_name}}">
                    </div>

        </div>
    </div>




@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection