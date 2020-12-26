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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Pending Application</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-active table-bordered table-hover container table-secondary small">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Balance Leaves</th>
                                    <th>Days Taken</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @isset($pendings)
                                @foreach($pendings as $key => $pending)
                                <tr>
                                    ` <td>{{ $pendings->firstItem() +$key }}.</td>
                                    <td>{{ $pending->user->name }}</td>
                                    <td>{{ $pending->user->leave->balance_leaves }}</td>
                                    <td>{{ $pending->days_taken }}</td>
                                    <td>{{ $pending->refLeaveType->leave_type_name }}</td>
                                    <td>{{ $pending->from }}</td>
                                    <td>{{ $pending->to }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                data-toggle="dropdown">More</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('applications.show', $pending->application_id)}}">Show</a>

                                                <form action="{{ route('users.approve', $pending->application_id)}}"
                                                    method="post">
                                                    @csrf
                                                    @method('GET')
                                                    <input class="dropdown-item text-success" role="button"
                                                        type="submit" value="Approve">
                                                </form>

                                                <form action="{{ route('users.reject', $pending->application_id)}}"
                                                    method="post">
                                                    @csrf
                                                    @method('GET')
                                                    <input class="dropdown-item text-danger" role="button" type="submit"
                                                        value="Reject">
                                                </form>

                                            </div>
                                        </div>

                                    </td>

                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                        {{ $pendings->links() }}

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
