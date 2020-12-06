@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800">Overview Report</h1></div>
                
                <!-- Employee Report -->
                <div class="row mb-3">
                    <div class="col-xl-4 col-md-12 mb-md-3 mb-sm-3">
                    <div class="card shadow">
                        <div class="card-body">
                        <div class="chart-pie pt-2 pb-3">
                            <canvas id="genderchart"></canvas>
                            <div class="no-data" id="genderchartnone">No data available!</div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-md-3 mb-sm-3">
                        <div class="card shadow">
                            <div class="card-body">
                            <div class="chart-pie pt-2 pb-3">
                                <canvas id="roleschart"></canvas>
                                <div class="no-data" id="roleschartnone">No data available!</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-md-3 mb-sm-3">
                        <div class="card shadow">
                            <div class="card-body">
                            <div class="chart-pie pt-2 pb-3">
                                <canvas id="empstatuschart"></canvas>
                                <div class="no-data" id="empstatuschartnone">No data available!</div>
                            </div>
                            </div>
                        </div>
                    </div>
                        
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Employee Report</h6>
                                </div>
                            <div class="card-body small">
        
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="employees_count">Total Employees:</label>
                                            <input class="form-control" type="text" name="employees_count" disabled value="{{$employees_count}}">
                                        </div> 
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="working_count">Total Working Employees:</label>
                                            <input class="form-control" type="text" name="working_count" disabled value="{{$working_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="resigned_count">Total Resign Employees:</label>
                                            <input class="form-control" type="text" name="resigned_count" disabled value="{{$resigned_count}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="admin_count">Total Admin:</label>
                                            <input class="form-control" type="text" name="admin_count" disabled value="{{$admin_count}}">
                                        </div> 
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="employee_count">Total Employee:</label>
                                            <input class="form-control" type="text" name="employee_count" disabled value="{{$employee_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="approver_count">Total Approver:</label>
                                            <input class="form-control" type="text" name="approver_count" disabled value="{{$approver_count}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="male_count">Total Male:</label>
                                            <input class="form-control" type="text" name="male_count" disabled value="{{$male_count}}">
                                        </div> 
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="female_count">Total Female:</label>
                                            <input class="form-control" type="text" name="female_count" disabled value="{{$female_count}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leave Report-->
                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Leave Report</h6>
                                </div>
                            <div class="card-body small">
        
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="annual_e_average">Annual Entitlement Average (Per Employee):</label>
                                            <input class="form-control" type="text" name="annual_e_average" disabled value="{{$annual_e_average}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="carry_over_sum">Total Carry Over (This Year):</label>
                                            <input class="form-control" type="text" name="carry_over_sum" disabled value="{{$carry_over_sum}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="balance_leaves_sum">Total Available Leaves (This Year):</label>
                                            <input class="form-control" type="text" name="balance_leaves_sum" disabled value="{{$balance_leaves_sum}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="taken_so_far_sum">Total Leave Days Takens (This Year):</label>
                                            <input class="form-control" type="text" name="taken_so_far_sum" disabled value="{{$taken_so_far_sum}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="taken_so_far_sum_average">Average Leave Days Takens (Per Employee):</label>
                                            <input class="form-control" type="text" name="taken_so_far_sum_average" disabled value="{{$taken_so_far_sum_average}}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Report -->
                <div class="row mb-3">
                    <div class="col-xl-6 col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                    <div class="chart-pie pt-2 pb-3">
                                        <canvas id="thisyearapplicationchart"></canvas>
                                        <div class="no-data" id="thisyearapplicationchartnone">No data available!</div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                    <div class="chart-pie pt-2 pb-3">
                                        <canvas id="applicationstatuschart"></canvas>
                                        <div class="no-data" id="applicationstatuschartnone">No data available!</div>
                                    </div>
                            </div>
                        </div>
                    </div>
 
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Application Report</h6>
                                </div>
                            <div class="card-body small">
        
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="applications_count">Total Applications:</label>
                                            <input class="form-control" type="text" name="applications_count" disabled value="{{$applications_count}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="applications_this_year_count">Total Applications (This Year):</label>
                                            <input class="form-control" type="text" name="applications_this_year_count" disabled value="{{$applications_this_year_count}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="pending_count">Total Pending Application:</label>
                                            <input class="form-control" type="text" name="pending_count" disabled value="{{$pending_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="approve_count">Total Approved Applications:</label>
                                            <input class="form-control" type="text" name="approve_count" disabled value="{{$approve_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="reject_count">Total Rejected Applications:</label>
                                            <input class="form-control" type="text" name="reject_count" disabled value="{{$reject_count}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="pending_this_year_count">Total Pending Application (This Year):</label>
                                            <input class="form-control" type="text" name="pending_this_year_count" disabled value="{{$pending_this_year_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="approve_this_year_count">Total Approved Applications (This Year):</label>
                                            <input class="form-control" type="text" name="approve_this_year_count" disabled value="{{$approve_this_year_count}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="reject_this_year_count">Total Rejected Applications (This Year):</label>
                                            <input class="form-control" type="text" name="reject_this_year_count" disabled value="{{$reject_this_year_count}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Holiday Report -->
                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Holiday Report</h6>
                                </div>
                            <div class="card-body small">
        
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label class="label" for="holidays_count">Total Public Holidays (This Year):</label>
                                            <input class="form-control" type="text" name="holidays_count" disabled value="{{$holidays_count}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graph/Chart -->

    
</div>

@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection