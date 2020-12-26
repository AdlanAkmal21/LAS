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

                <div class="row justify-content-center mb-3">
                    <div class="col-md-10">
                        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                    </div>
                </div>
                @include('partials._validation')
                @include('partials._notifications')

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">

                            <div class="card-body">
                                <form method="POST" action="{{ route('users.change_password') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="current_password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="current_password" type="password" class="form-control"
                                                name="current_password" value="{{old('current_password')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="new_password" type="password" class="form-control"
                                                name="new_password" value="{{old('new_password')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_confirm_password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="new_confirm_password" type="password" class="form-control"
                                                name="new_confirm_password" value="{{old('new_confirm_password')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-warning">
                                                {{ __('Change Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
