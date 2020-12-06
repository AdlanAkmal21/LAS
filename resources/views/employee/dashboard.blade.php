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
        <div class="col-lg-4">
          <div class="card shadow mb-4" style="height: 180px;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Work Board</h6>
            </div>
            <div class="card-body">
              <h6 id="date"></h6>
              <h1 id="clock" class="display-4"></h1>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card shadow mb-4" style="height: 180px;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Notice Board</h6>
            </div>
            <div class="card-body">
                <p>First time user? Consider changing your password.</p>
                <a class="btn btn-warning btn-sm" href="{{ route('password.request') }}">Reset Password</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        @if ($user->role_id == 3)
        <div class="col mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending Requests</div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{$approvers_pending_count}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-exclamation-circle fa-3x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
    </div>

    @isset($user->leave)
    <div class="row">
      <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Leave Days Taken (This Year)</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$user->leave->taken_so_far}}</div>
              </div>
              <div class="col-auto">
                <i class="far fa-sticky-note fa-3x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Leave (This Year)</div>
                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$user->leave->balance_leaves}}</div>
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
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Applications (Overall)</div>
          <div class="h3 mb-0 font-weight-bold text-gray-800">{{$applications_count}}</div>
          </div>
          <div class="col-auto">
            <i class="far fa-calendar-alt fa-3x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Applications (This Year)</div>
          <div class="h3 mb-0 font-weight-bold text-gray-800">{{$applications_count_this_year}}</div>
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

      
@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection