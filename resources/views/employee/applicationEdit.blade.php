@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Edit Leave Application</h1>
</div>

    <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('applications.update', $application->id) }}">
                        @method('PATCH') 
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label">Employee ID</label>
                                    <input class="form-control" type="text" name="id" readonly placeholder="{{$application->user->id}}">
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="leave_type_id">Leave Type</label>
                                    <input class="form-control" type="text" name="leave_type_id" readonly placeholder="{{$application->refLeaveType->leave_type_name}}">
                                </div>
                            </div>
                        </div>               

                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                                    <label class="label">From</label>
                            <input class="form-control" type="date" name="from" value="{{$application->from}}">
                                    <span class="text-danger">{{ $errors->first('from') }}</span>
                                </div>
                            </div>
    
                            <div class="col">
                            <div class="form-group">
                                    <label class="label">To</label>
                                    <input class="form-control" type="date" name="to" value="{{$application->to}}">
                                    <span class="text-danger">{{ $errors->first('to') }}</span>
    
                                </div>
                            </div>
                        </div>
    
    
                        <div class="form-group">
                            <label class="label">Reason</label>
                            <textarea rows = "2" cols = "50" name = "reason" class="form-control">{{$application->reason}}</textarea>
                            <span class="text-danger">{{ $errors->first('reason') }}</span>
                        </div>
    
                        <div class="p-t-15">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a class="btn btn-danger" href="{{ route('applications.list')}}">Cancel</a>
                        </div>
                    </form>       
                    
                </div>
            </div>
    
    

@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection