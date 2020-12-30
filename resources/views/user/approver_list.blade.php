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

                        <div class="table-responsive-lg">
                            <table
                                class="table table-active table-bordered table-hover container table-secondary small">
                                <thead class="text-center">
                                    <tr class="table-secondary">
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
                                        <td>{{ $pendings->firstItem() +$key }}.</td>
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
                                                        href="{{ route('applications.show', $pending->pending_id)}}">Show</a>

                                                    <form action="{{ route('users.approve', $pending->pending_id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('GET')
                                                        <input class="dropdown-item text-success" role="button"
                                                            type="submit" value="Approve">
                                                    </form>

                                                    <form action="{{ route('users.reject', $pending->pending_id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('GET')
                                                        <input class="dropdown-item text-danger" role="button"
                                                            type="submit" value="Reject">
                                                    </form>

                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        {{ $pendings->links() }}
                    </div>
                </div>

                <div class="d-sm-flex align-items-center justify-content-between my-4">
                    <h1 class="h3 mb-0 text-gray-800">Approved Application</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive-lg">
                            <table class="table table-active table-bordered table-hover container table-success small">
                                <thead class="text-center">
                                    <tr class="table-success">
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

                                    @isset($approved)
                                    @foreach($approved as $key => $approve)
                                    <tr>
                                        <td>{{ $approved->firstItem() +$key }}.</td>
                                        <td>{{ $approve->user->name }}</td>
                                        <td>{{ $approve->user->leave->balance_leaves }}</td>
                                        <td>{{ $approve->days_taken }}</td>
                                        <td>{{ $approve->refLeaveType->leave_type_name }}</td>
                                        <td>{{ $approve->from }}</td>
                                        <td>{{ $approve->to }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('applications.show', $approve->approved_id)}}">
                                                Show
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        {{ $approved->links() }}
                    </div>
                </div>

                <div class="d-sm-flex align-items-center justify-content-between my-4">
                    <h1 class="h3 mb-0 text-gray-800">Rejected Application</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive-lg">
                            <table class="table table-active table-bordered table-hover table-danger container small">
                                <thead class="text-center">
                                    <tr class="table-danger">
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

                                    @isset($rejected)
                                    @foreach($rejected as $key => $reject)
                                    <tr>
                                        <td>{{ $rejected->firstItem() +$key }}.</td>
                                        <td>{{ $reject->user->name }}</td>
                                        <td>{{ $reject->user->leave->balance_leaves }}</td>
                                        <td>{{ $reject->days_taken }}</td>
                                        <td>{{ $reject->refLeaveType->leave_type_name }}</td>
                                        <td>{{ $reject->from }}</td>
                                        <td>{{ $reject->to }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('applications.show', $reject->rejected_id)}}">
                                                Show
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        {{ $rejected->links() }}
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
