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
                    <h1 class="h3 mb-0 text-gray-800">Edit Leave Application</h1>
                </div>
                <p class="small">If you're experiencing any problems, try refreshing the page or re-select the dates.
                </p>
                @include('partials._validation')
                @include('partials._notifications')
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{ route('applications.update', $application->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="label">Employee ID</label>
                                        <input class="form-control" type="text" name="id" readonly
                                            value="{{$application->user->id}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="label" for="leave_type_id">Leave Type</label>
                                        <input class="form-control" type="text" name="leave_type_id" id="leave_type_id"
                                            readonly value="{{$application->refLeaveType->leave_type_name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="label" for="from">From</label>
                                        <input class="form-control" placeholder="dd/mm/yyyy" name="from" type="text"
                                            id="from" value="{{ old('from', $from)}}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="label" for="to">To</label>
                                        <input class="form-control" type="text" placeholder="dd/mm/yyyy" name="to"
                                            id="to" value="{{ old('to', $to)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="label">Reason</label>
                                        <input name="reason" type="text" class="form-control"
                                            value="{{ old('reason', $application->reason)}}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="label" for="days_taken">Days Taken</label>
                                        <input class="form-control" type="text" id="days_taken" name="days_taken"
                                            readonly="readonly"
                                            value="{{ old('days_taken', $application->days_taken)}}">
                                    </div>
                                </div>
                            </div>

                            @if ($application->half_day == null)
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
                            @endif

                            <div class="p-t-15">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a class="btn btn-danger" href="{{ route('applications.list')}}">Cancel</a>
                            </div>
                        </form>

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
