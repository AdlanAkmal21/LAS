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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>


                <div class="row my-3">
                    <div class="col-xl-6 col-lg-12 mb-2 mb-xl-0">
                        <div class="card shadow" style="height: 100%;">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Work Board</h6>
                            </div>
                            <div class="card-body">
                                <h6 id="date"></h6>
                                <h1 id="clock" class="display-4"></h1>
                                <p>Welcome! Here's a few functions to get you started.</p>

                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('admins.employeeadd') }}"
                                            class="btn btn-primary btn-sm btn-block">Add Employee
                                        </a>
                                        <a href="{{ route('holidays.create') }}"
                                            class="btn btn-warning btn-sm btn-block">Add Holiday
                                        </a>
                                        <a href="{{ route('report.overview') }}"
                                            class="btn btn-success btn-sm btn-block">Overview Report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 mb-2 mb-xl-0">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 my-1">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <a href="{{ route('admins.employeelist') }}" class="stretched-link"></a>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total
                                                    Employees</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$employees_count}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-question fa-3x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 my-1">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Total
                                                    Resigned Employees</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$resigned_count}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-eraser fa-3x text-gray-300"></i>
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
                                        <a href="{{ route('admins.applicationlist') }}" class="stretched-link"></a>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total
                                                    Applications (Overall)</div>
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
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Total
                                                    Applications (This Year)</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                                    {{$applications_this_year_count}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 my-1">
                                <div class="card border-left-dark shadow h-100 py-2">
                                    <div class="card-body">
                                        <a href="{{ route('holidays.index') }}" class="stretched-link"></a>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                                                    Total
                                                    Holidays (This Year)</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$holidays_count}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-holly-berry fa-3x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 my-1">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Leave
                                                    Days Taken (This Year)</div>
                                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                                    {{$taken_so_far_sum}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-sticky-note fa-3x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 mb-2 mb-xl-0">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Off-Duty (This Week)
                                    <span style="font-size: 12px; color:gray;">[{{$offduty_count}} Employees]</span>
                                </h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body small">
                                @if($offduty_count != 0)
                                <ul class="list-group pre-scrollable" style="height:200px;">
                                    @foreach ($offduty as $off)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-xl-8">
                                                        <div class="row pl-2"><u>Name</u></div>
                                                        <div class="row pl-2"><b>{{$off->name}}</b></div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="row pl-2"><u>Period</u></div>
                                                        <div class="row pl-2">From:</div>
                                                        <div class="row pl-2"><b>{{$off->from}}</b></div>
                                                        <div class="row pl-2">To:</div>
                                                        <div class="row pl-2"><b>{{$off->to}}</b></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <ul class="list-group" style="height:200px;">
                                    <li class="list-group-item">
                                        <div class="font-weight-bold text-uppercase mb-1">
                                            <i class="fas fa-user-check"></i>
                                            <span class="text-success pl-3">
                                                All Employees Are Working
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                @endif
                            </div>
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
