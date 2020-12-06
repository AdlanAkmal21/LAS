@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

    @if(session()->has('error'))
    <div class="alert alert-warning fade-message">
        <b style="font-size:18px">
        {{ session()->get('error') }}
        </b>
    </div>
    @endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Leave Application Form</h1>
</div>

    @isset($leave)
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('applications.store')}}">
                @csrf
                <div class="form-row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label class="label" for="name">Employee Name</label>
                            <input class="form-control" type="text" name="name" disabled placeholder="{{$user->name}}">
                        </div> 
                    </div>
                    <div class="col-xl-8">
                        <div class="form-group">
                            <label class="label" for="leave_type_id">Leave Type</label>
                            <select class="form-control" id="leave_type_id" name="leave_type_id">
                                <option selected disabled >Select Leave Type</option>
                                @foreach ($refLeaveTypes as $refLeaveType)
                                    <option value="{{$refLeaveType->id}}">{{$refLeaveType->leave_type_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('leave_type_id') }}</span>
                        </div>
                    </div>
                </div>



                    <div class="form-row">
                        <div class="col-xl-4">
                        <div class="form-group">
                                <label class="label" for="from">From</label>
                                <input class="form-control" type="text" placeholder="yyyy/mm/dd" name="from" id="from">
                                <span class="text-danger">{{ $errors->first('from') }}</span>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="label" for="to">To</label>
                                <input class="form-control" type="text" placeholder="yyyy/mm/dd" name="to" id="to">
                                <span class="text-danger">{{ $errors->first('to') }}</span>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="label" for="days_taken">Days Taken</label>
                                <input class="form-control"  type="text" id="days_taken" name="days_taken" readonly="readonly">                    
                            </div>
                        </div>
                    </div> 

                    <div class="form-row">
                        <div class="col-xl-12">
                        <div class="form-group">
                            <label for="myCheck">Half Day</label> 
                            <input type="checkbox" value="1" id="half_day" name="half_day">
                            </div>
                        </div>
                    </div>

                        <div class="form-row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="label" for="reason">Reason</label>
                                    <input name = "reason" class="form-control" placeholder="State your reason..">
                                    <span class="text-danger">{{ $errors->first('reason') }}</span>
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
        <div class="card">
            <div class="card-body shadow mb-3">
                <h4 class="display-6" style="text-align: center;">
                    Leave Record is Not Found!
                </h4>
            </div>
        </div>

    @endempty



@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection