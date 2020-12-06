@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

    @if(session()->has('success'))
    <div class="alert alert-success fade-message">
        {{ session()->get('success') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-warning fade-message">
        {{ session()->get('error') }}
    </div>
    @endif


<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
<a type="button" class="btn btn-success btn-sm" href="{{ route('admins.employeelist') }}">To Employees List</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admins.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="Enter Employee Name..">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Enter Email..">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="ic" class="col-md-4 col-form-label text-md-right">{{ __('IC Number') }}</label>

                <div class="col-md-6">
                    <input id="ic" type="text" class="form-control @error('ic') is-invalid @enderror" name="ic" required placeholder="Enter IC Number..">

                    @error('ic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phoneNum" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                <div class="col-md-6">
                    <input id="phoneNum" type="tel" class="form-control @error('phoneNum') is-invalid @enderror" name="phoneNum" required placeholder="Enter Phone Number..">

                    @error('phoneNum')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="date_joined" class="col-md-4 col-form-label text-md-right">{{ __('Date Joined') }}</label>

                <div class="col-md-6">
                    <input id="date_joined" type="text" class="form-control @error('date_joined') is-invalid @enderror" name="date_joined" value="{{ old('date_joined') }}" required autocomplete="date_joined" placeholder="Select Date Joined..">

                    @error('date_joined')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="gender_id" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">
                    @foreach ($genders as $gender)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender_id" id="{{$gender->gender_name}}" value="{{$gender->id}}">
                            <label class="form-check-label" for="{{$gender->gender_name}}">{{$gender->gender_name}}</label>
                        </div>                        
                    @endforeach

                    @error('gender_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                <div class="col-md-6">
                    <select required class="form-control @error('role_id') is-invalid @enderror" name="role_id" required="required">
                        <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>Role field is required.</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="approver_id" class="col-md-4 col-form-label text-md-right">{{ __('Approved By') }}</label>

                <div class="col-md-6">
                    <select class="form-control @error('approver_id') is-invalid @enderror" name="approver_id">
                        <option selected disabled>Select Approver</option>
                                <option value="">None</option>
                            @foreach ($approvers as $approver)
                                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                            @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <div class="p-t-15">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>                        
                        <button type="reset" class="btn btn-danger">
                            {{ __('Clear') }}
                        </button>
                    </div>
                </div>
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