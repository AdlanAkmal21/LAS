@extends('layouts.wrapper')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0 text-gray-800"><span style="font-weight: bold;">{{$user->name}}</span> (Individual
        Report)</h4>
</div>

<div class="card my-3">
    <div class="card-header"><b>{{ __('Employee Detail') }} <span class="text-primary">(ID:
                {{$user->id}})</span></b></div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label class="label" for="name">Employee Name</label>
                    <input class="form-control" type="text" name="name" disabled value="{{$user->name}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" disabled value="{{$user->email}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="phoneNum">Phone Number</label>
                    <input class="form-control" type="text" name="phoneNum" disabled
                        value="{{$user->employee->phoneNum}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="date_joined">Date Joined</label>
                    <input class="form-control" type="date" name="date_joined" disabled
                        value="{{$user->employee->date_joined}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="approver_id">Approved By</label>
                    <input class="form-control" type="text" name="approver_id" disabled
                        value="{{$current_approver_name}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="role_id">Role</label>
                    <input class="form-control" type="text" name="role_id" disabled
                        value="{{$user->refRole->role_name}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="emp_status_id">Employee Status</label>
                    <input class="form-control" type="text" name="emp_status_id" disabled
                        value="{{$user->refEmpStatus->emp_status_name}}">
                </div>
            </div>
        </div>


    </div>
</div>

@isset($leave)
<div class="card my-3">
    <div class="card-header"><b>{{ __('Leave Details') }}</b></div>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="annual_e">Annual Entitlement</label>
                    <input class="form-control" type="text" name="annual_e" disabled value="{{$leave->annual_e}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="carry_over">Carry Over</label>
                    <input class="form-control" type="text" name="carry_over" disabled value="{{$leave->carry_over}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="total_leaves">Total Leaves (Current Year)</label>
                    <input class="form-control" type="text" name="total_leaves" disabled
                        value="{{$leave->total_leaves}}">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label class="label" for="taken_so_far">Leaves Taken (Current Year)</label>
                    <input class="form-control" type="text" name="taken_so_far" disabled
                        value="{{$leave->taken_so_far}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="form-group">
                    <label class="label" for="balance_leaves">Balance Leaves</label>
                    <input class="form-control" type="text" name="balance_leaves" disabled
                        value="{{$leave->balance_leaves}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col">
        <div class="card my-3">
            <div class="card-header"><b>{{ __('Application Details') }}</b></div>
            <div class="card-body">

                <div class="row px-2">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="label" for="applications_count">Total Applications Applied
                                (Overall)</label>
                            <input class="form-control" type="text" name="applications_count" disabled
                                value="{{$applications_count}}">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="label" for="applications_this_year_count">Total Applications
                                Applied (This Year)</label>
                            <input class="form-control" type="text" name="applications_this_year_count" disabled
                                value="{{$applications_this_year_count}}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row px-2">
                    <div class="col-xl-6 col-md-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="pending_count">Total Pending
                                        Applications</label>
                                    <input class="form-control" type="text" name="pending_count" disabled
                                        value="{{$pending_count}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="approved_count">Total Approved
                                        Applications</label>
                                    <input class="form-control" type="text" name="approved_count" disabled
                                        value="{{$approved_count}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="rejected_count">Total Rejected
                                        Applications</label>
                                    <input class="form-control" type="text" name="rejected_count" disabled
                                        value="{{$rejected_count}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="chart-pie">
                            <canvas id="individualappstatuschart"></canvas>
                            <div class="no-data" id="individualappstatuschartnone">No data available!
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row px-2">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="label" for="applications_days_taken_sum">Application Days
                                Taken (This Year)</label>
                            <input class="form-control" type="text" name="applications_days_taken_sum" disabled
                                value="{{$applications_days_taken_sum}}">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="label" for="applications_days_taken_avg">Average Application
                                Days Taken (Per Application)</label>
                            <input class="form-control" type="text" name="applications_days_taken_avg" disabled
                                value="{{$applications_days_taken_avg}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset

@empty($leave)
<div class="card my-3">
    <div class="card-header"><b>{{ __('Leave Details') }}</b></div>
    <div class="card-body">
        <h4 class="text-center my-3">Leave Record is Not Found!</h4>
    </div>
</div>

<div class="card my-3">
    <div class="card-header"><b>{{ __('Application Details') }}</b></div>
    <div class="card-body">
        <h4 class="text-center my-3">Application Record is Not Found!</h4>
    </div>
</div>
@endempty


@endsection
