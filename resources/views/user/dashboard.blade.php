@extends('layouts.wrapper')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

@include('partials._notifications')
<div class="row my-3">
    <div class="col-xl-6 col-lg-12 mb-2 mb-xl-0">
        <div class="card shadow" style="height: 100%;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Work Board</h6>
            </div>
            <div class="card-body">
                <h6 id="date"></h6>
                <h1 id="clock" class="display-4" style="color:#222222"></h1>
                <p>First time user? Consider changing your password.</p>
                <a class="btn btn-warning btn-sm btn-block" href="{{ route('reset.view')}}">Change
                    Password</a>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-12 mb-2 mb-xl-0">
        @if ($user->role_id == 3)
        <div class="row">
            <div class="col-xl-12 col-lg-12 my-1">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <a href="{{ route('approver.approver_list', Auth::id()) }}" class="stretched-link"></a>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pending
                                    Requests</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    {{$approvers_pending_count}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-circle fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @isset($user->leave)
        <div class="row">
            <div class="col-xl-6 col-lg-12 my-1">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Leave
                                    Days Taken (This Year)
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    {{$user->leave->taken_so_far}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-sticky-note fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 my-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Available
                                    Leave (This Year)
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    {{$user->leave->balance_leaves}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-12 my-1">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <a href="{{ route('application.index')}}" class="stretched-link"></a>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total
                                    Applications (Overall)
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    {{$applications_count}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 my-1">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total
                                    Applications (This
                                    Year)</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    {{$applications_count_this_year}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </div>

</div>


@endsection
