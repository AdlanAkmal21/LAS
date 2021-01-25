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

                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Leave Application Form</h1>
                </div>

                @include('partials._validation')
                @include('partials._notifications')

                @isset($leave)
                <p class="small">If you're experiencing any problems, try refreshing the page or re-select the dates.
                </p>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form method="post" action="{{ route('applications.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" readonly="readonly" id="name"
                                        value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="leave_type_id" class="col-sm-2 col-form-label">Leave Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="leave_type_id" name="leave_type_id">
                                        <option selected disabled value="0">Select Leave Type</option>
                                        @foreach ($refLeaveTypes as $refLeaveType)
                                        <option @if(old('leave_type_id')==$refLeaveType->id
                                            )
                                            selected
                                            @endif
                                            value="{{$refLeaveType->id}}">{{$refLeaveType->leave_type_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="from" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10 form-inline">
                                    <div class="form-group mr-2 flex-fill">
                                        <input type="text" class="form-control flex-fill" name="from" id="from"
                                            placeholder="Select From Date (dd/mm/yyyy) .." value="{{ old('from') }}">
                                    </div>
                                    <div class="form-group mr-2 flex-fill">
                                        <input type="text" class="form-control flex-fill" name="to" id="to"
                                            placeholder="Select To Date (dd/mm/yyyy) .." value="{{ old('to') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="days_taken" class="col-sm-2 col-form-label">Days Taken</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="days_taken" name="days_taken"
                                        placeholder="Please select dates." readonly="readonly"
                                        value="{{ old('days_taken') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="check" class="col-sm-2 col-form-label">Half Day</label>
                                <div class="col-sm-10">
                                    <div id="check" class="form-control border-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="half_day" id="morning"
                                                value="1" disabled>
                                            <label class="form-check-label" for="morning">Morning</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="half_day" id="evening"
                                                value="2" disabled>
                                            <label class="form-check-label" for="evening">Evening</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control mb-2" name="reason" style="resize:none"
                                        placeholder="State your reason..">{{ old('reason')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file" class="col-sm-2 col-form-label">Attachment
                                    <small>(optional)</small></label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" id="file" class="small form-control border-0">
                                </div>
                            </div>

                            <div class="form-group row pt-2">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endisset

                @empty($leave)
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h4 class="display-6" style="text-align: center;">
                            Leave Record is Not Found!
                        </h4>
                    </div>
                </div>
                @endempty



            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        <!-- Footer -->
        @include('partials._footer')
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
