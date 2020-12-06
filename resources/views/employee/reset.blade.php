@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Reset Password</h1>
</div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form @if(Auth::user()->role_id == 1)action="{{ route('employees.reset', Auth::id()) }}"@else action="{{ route('approvers.reset', Auth::id()) }}"@endif >
                        @method('PATCH') 
                        @csrf

                        <div class="form-group">
                            <label class="label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div> 

                        <div class="form-group">
                            <label class="label" for="current_password">Current Password</label>
                            <input class="form-control" type="password" name="current_password" required>
                        </div> 

                        <div class="form-group">
                            <label class="label" for="password">New Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div> 

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
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