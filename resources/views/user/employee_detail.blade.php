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

                <div class="card border-left-primary my-3 small">
                    <div class="card-header"><b>{{ __('Employee Details') }}</b>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="id">Employee ID</label>
                                        <input class="form-control" type="text" name="id" disabled
                                            value="{{$user->id}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="name">Employee Name</label>
                                        <input class="form-control" type="text" name="name" disabled
                                            value="{{$user->name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="email">Email</label>
                                        <input class="form-control" type="email" name="email" disabled
                                            value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="phoneNum">Phone Number</label>
                                        <input class="form-control" type="text" name="phoneNum" disabled
                                            value="{{$user->employee->phoneNum}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="date_joined">Date Joined</label>
                                        <input class="form-control" type="date" name="date_joined" disabled
                                            value="{{$user->employee->date_joined}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="approver_id">Approved By</label>
                                        <input class="form-control" type="text" name="approver_id" disabled
                                            value="{{$current_approver_name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="role_id">Role</label>
                                        <input class="form-control" type="text" name="role_id" disabled
                                            value="{{$user->refRole->role_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="emp_status_id">Employee Status</label>
                                        <input class="form-control" type="text" name="emp_status_id" disabled
                                            value="{{$user->refEmpStatus->emp_status_name}}">
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                @isset($leave)
                <div class="card border-left-info my-3 small">
                    <div class="card-header"><b>{{ __('Leave Details') }}</b>
                    </div>
                    <div class="card-body">

                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="annual_e">Annual Entitlement</label>
                                        <input class="form-control" type="text" name="annual_e" disabled
                                            value="{{$leave->annual_e}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="carry_over">Carry Over</label>
                                        <input class="form-control" type="text" name="carry_over" disabled
                                            value="{{$leave->carry_over}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="total_leaves">Total Leaves (Current
                                            Year)</label>
                                        <input class="form-control" type="text" name="total_leaves" disabled
                                            value="{{$leave->total_leaves}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="taken_so_far">Leaves Taken (Current
                                            Year)</label>
                                        <input class="form-control" type="text" name="taken_so_far" disabled
                                            value="{{$leave->taken_so_far}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="label" for="balance_leaves">Balance Leaves</label>
                                        <input class="form-control" type="text" name="balance_leaves" disabled
                                            value="{{$leave->balance_leaves}}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endisset

                @empty($leave)
                <div class="card border-left-danger my-3">
                    <div class="card-header"><b>{{ __('Leave Details') }}</b>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center my-3">Leave Record is Not Found!</h4>
                    </div>
                </div>
                @endempty

            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
