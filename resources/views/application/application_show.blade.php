@extends('layouts.wrapper')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
    <a href="{{ route('application.index') }}" class="btn btn-success btn-sm">To application
        list</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="name">Employee Name</label>
                    <input class="form-control" type="text" name="name" disabled value="{{$application->user->name}}">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="leave_type_id">Leave Type</label>
                    <input class="form-control" type="text" name="leave_type_id" disabled
                        value="{{$application->refLeaveType->leave_type_name}}">
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="from">From</label>
                    <input class="form-control" type="date" value="{{$application->from}}" disabled name="from"
                        id="from">
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="to">To</label>
                    <input class="form-control" type="date" value="{{$application->to}}" disabled name="to" id="to">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="days_taken">Days Taken</label>
                    <input class="form-control" type="text" value="{{$application->days_taken}}" disabled
                        name="days_taken" id="days_taken">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                @isset($half_day)
                <div class="form-group">
                    <label class="label" for="half_day">Half Day:</label>
                    <input class="form-control" type="text" value="{{$half_day}}" disabled name="half_day"
                        id="half_day">
                </div>
                @endisset
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="approver_id">Approved By</label>
                    <input class="form-control" type="text"
                        value="@empty($application->user->employee->approver->name)None @else{{$application->user->employee->approver->name}}@endempty"
                        disabled name="approver_id" id="approver_id">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="reason">Reason</label>
                    <input class="form-control" type="text" value="{{$application->reason}}" disabled name="reason"
                        id="reason">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="created_at">Applied At</label>
                    <input class="form-control" type="text" value="{{$created_at}}" disabled name="created_at"
                        id="created_at">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="form-group">
                    <label class="label" for="file">Attachment:</label>
                    @isset($file)
                    <a class="form-control border-0" href="{{asset("storage/$file->filecategory/$file->filename")}}"
                        name="file" id="file"><i class="fa fa-file fa-lg mr-2"></i> {{$file->filename}}</a>
                    @endisset
                    @empty($file)
                    <input type="text" class="form-control" disabled value="No attachment available.">
                    @endempty
                </div>
            </div>

        </div>


        @isset($application->approval_date)
        <div class="form-group">
            <label for="approval_date">Approval Date:</label>
            <input type="text" class="form-control text-center" disabled name="approval_date" id="approval_date"
                value="{{$application->approval_date}}">
        </div>
        @endisset

        <div class="form-group">
            <label for="application_status_id">Application Status:</label>
            <input type="text" class="form-control form-control-lg text-center" style="font-size: 32px;" disabled
                name="application_status_id" value="{{$application->refAppStatus->application_status_name}}">
        </div>

    </div>
</div>



@endsection
