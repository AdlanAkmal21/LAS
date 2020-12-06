@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Edit Employee</h1>
</div>

    <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('admins.update', $user->id) }}">
                        @method('PATCH') 
                        @csrf    
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="name">Employee Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$user->name}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="email">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="phoneNum">Phone Number</label>
                                    <input class="form-control" type="text" name="phoneNum" value="{{$user->employee->phoneNum}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="approver_id">Approved By</label>
                                        <select class="form-control" name="approver_id">
                                        <option value="{{$current_approver_id}}">{{$current_approver_name}}</option>
                                            @if($current_approver_id != null)
                                            <option value="">None</option>
                                            @endif

                                            @foreach ($approvers as $approver)
                                                @if($approver->id != $user->id)
                                                    @if ($approver->id != $current_approver_id)
                                                    <option value="{{$approver->id}}">{{$approver->name}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>                                
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="label" for="emp_status_id">Employee Status</label>
                                    <select class="form-control" name="emp_status_id">
                                    <option selected value="{{$user->emp_status_id}}">{{$user->refEmpStatus->emp_status_name}}</option>
                                        @foreach ($refEmpStatus as $item)
                                            @if($item->id != $user->emp_status_id)
                                            <option value="{{$item->id}}">{{$item->emp_status_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                
                                </div> 
                            </div>
                        </div>       

                        <div class="p-t-15">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a class="btn btn-danger" href="{{ route('admins.employeelist')}}">Cancel</a>
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