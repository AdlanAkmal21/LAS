@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>


      <div class="row">
        <div class="col-xl-6 col-md-6">
          <div class="card shadow mb-4" style="height:300px;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Work Board</h6>
            </div>
            <div class="card-body">
              <h6 id="date"></h6>
              
              <h1 id="clock" class="display-4"></h1>
              <p>Welcome! Here's a few functions to get you started.</p>
              <div class="row">
                  <div class="col">
                      {{-- <a class="btn btn-primary btn-sm"  >Add Employee</a>
                      <a class="btn btn-warning btn-sm"  >Add Holiday</a>
                      <a class="btn btn-success btn-sm"  >Generate Overview</a> --}}
                      <a href="{{ route('admins.employeeadd') }}" class="btn btn-primary btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="text">Add Employee</span>
                      </a>
                      <a href="{{ route('holidays.create') }}" class="btn btn-warning btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fas fa-candy-cane"></i>
                        </span>
                        <span class="text">Add Holiday</span>
                      </a>
                      
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6  col-md-6">
          <div class="card shadow mb-4"  style="height:300px;">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Off-Duty (This Week)</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body small">


                @if (empty($offduty))
                  <ul class="list-group pre-scrollable" style="height:180px;">
                    @foreach ($offduty as $off)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xl-7 col-md-12">
                                        <div class="row pl-2"><u>Name</u></div>
                                        <div class="row pl-2"><b>{{$off->name}}</b></div>
                                </div>
                                <div class="col-xl-5 col-md-12">
                                        <div class="row pl-2"><u>Period</u></div>
                                        <div class="row pl-2"><b>{{$off->from}}</b>  -  <b>{{$off->to}}</b></div>
                                </div>
                            </div>
                        </li> 
                      </ul> 
                    @endforeach                 
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

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <a href="{{ route('admins.employeelist') }}" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Employees</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$employees_count}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-question fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <a href="{{ route('admins.applicationlist') }}" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Applications</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$applications_count}}</div>
                </div>
                <div class="col-auto">
                  <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
              <a href="{{ route('holidays.index') }}" class="stretched-link"></a>
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Holidays (This Year)</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$holidays_count}}</div>
              </div>
                <div class="col-auto">
                  <i class="fas fa-holly-berry fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="row">
        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Resigned Employees</div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{$resigned_count}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-eraser fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Applications (This Year)</div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{$applications_this_year_count}}</div>
                </div>
                <div class="col-auto">
                  <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Leave Days Taken (This Year)</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$taken_so_far_sum}}</div>
                </div>
                <div class="col-auto">
                  <i class="far fa-sticky-note fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>  
      
    
@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection