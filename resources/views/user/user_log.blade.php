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

                @include('partials._notifications')
                <div class="card border-left-danger shadow h-100 my-3 rounded-lg py-4">
                    <div class="card-body">
                        <div class="container">
                            <h5 class="mb-0">{{Auth::user()->refRole->role_name}}</h5>
                            <h2 class="text-gray-800">{{Auth::user()->name}}</h2>
                        </div>

                        <div class="row my-4">
                            <div class="col-xl-4 col-lg-4 text-center text-xl-left text-lg-left mx-auto my-auto">
                                <div class="ml-xl-4 ml-lg-4 text-center border rounded-pill px-3 py-3">
                                    <h6 id="date"></h6>
                                    <h1 id="clock" class="display-5" style="color:#222222"></h1>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 pr-xl-5 pr-lg-5">
                                <div class="row my-3">
                                    <div class="col-xl-6 mb-xl-0 mb-3">
                                        <input class="form-control text-center" type="text" name="clock_in"
                                            id="clock_in" readonly @if (empty($today->clock_in)) value="--:--:--"
                                        @else
                                        value="{{date('h:i:s A', strtotime($today->clock_in))}}" @endif>
                                    </div>
                                    <div class="col-xl-6">
                                        <form action="{{ route('attendance.clockIn') }}" method="post">
                                            @csrf
                                            <input class="btn btn-primary btn-block active" type="submit"
                                                value="Clock In">
                                        </form>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-xl-6 mb-xl-0 mb-3">
                                        <input class="form-control text-center" type="text" name="clock_out"
                                            id="clock_out" readonly @if (empty($today->clock_out)) value="--:--:--"
                                        @else
                                        value="{{date('h:i:s A', strtotime($today->clock_out))}}" @endif>
                                    </div>
                                    <div class="col-xl-6">
                                        <form action="{{ route('attendance.clockOut') }}" method="post">
                                            @csrf
                                            <input class="btn btn-primary btn-block active" type="submit"
                                                value="Clock Out">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <ul class="list-group small text-center mb-3">
                            <li class="list-group-item list-group-item-secondary">
                                <div class="row">
                                    <div class="col-3">Day</div>
                                    <div class="col-3">Work Period</div>
                                    <div class="col-3">In</div>
                                    <div class="col-3">Out</div>
                                </div>
                            </li>

                            @if ($all_logs->isNotEmpty())

                            @if ($today == null)
                            <li class="list-group-item list-group-item-warning text-center">
                                <span>
                                    You have not clocked in today.
                                </span>
                            </li>
                            @endif

                            @foreach ($all_logs as $all_log)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-3">
                                        {{-- {{date('d/m', strtotime($all_log->date))}}<br> --}}
                                        {{-- {{date('D', strtotime($all_log->date))}} --}}
                                        {{date('D, j F', strtotime($all_log->date))}}
                                    </div>
                                    <div class="col-3">
                                        @if ($all_log->period) {{ $all_log->period }} @else -- @endif
                                    </div>
                                    <div class="col-3">
                                        @if ($all_log->clock_in) {{date('h:i:s A', strtotime($all_log->clock_out))}}
                                        @else --:--:-- @endif
                                    </div>
                                    <div class="col-3">
                                        @if ($all_log->clock_out) {{date('h:i:s A', strtotime($all_log->clock_out))}}
                                        @else --:--:-- @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach

                            @else
                            <li class="list-group-item text-center">
                                <span>
                                    User's history log unavailable.
                                </span>
                            </li>
                            @endif
                        </ul>
                        {{ $all_logs->links() }}

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
