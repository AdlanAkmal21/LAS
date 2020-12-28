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
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('applications.store')}}">
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="label" for="name">Employee Name</label>
                                        <input class="form-control" type="text" name="name" disabled
                                            placeholder="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="form-group">
                                        <label class="label" for="leave_type_id">Leave Type</label>
                                        <select class="form-control" id="leave_type_id" name="leave_type_id">
                                            <option selected disabled>Select Leave Type</option>
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
                            </div>



                            <div class="form-row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="label" for="from">From</label>
                                        <input class="form-control" type="text" placeholder="dd/mm/yyyy" name="from"
                                            id="from" value="{{ old('from') }}">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="label" for="to">To</label>
                                        <input class="form-control" type="text" placeholder="dd/mm/yyyy" name="to"
                                            id="to" value="{{ old('to') }}">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="label" for="days_taken">Days Taken</label>
                                        <input class="form-control" type="text" id="days_taken" name="days_taken"
                                            readonly="readonly" value="{{ old('days_taken') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="half_day">Half Day</label>
                                        <input type="checkbox" value="1" id="half_day" disabled name="half_day">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="label" for="reason">Reason</label>
                                        <input name="reason" style="resize:none" class="form-control"
                                            placeholder="State your reason..">
                                    </div>
                                </div>
                            </div>


                            <div class="p-t-15">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                <button type="reset" class="btn btn-danger">Clear</button>
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
