@extends('layouts.wrapper')
@section('content')

@include('partials._notifications')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Approver List</h1>
</div>

<div class="card shadow-sm border-left-secondary mb-4">
    <div class="card-header">Pending Application</div>
    <div class="card-body text-center">
        @if ($pendings->isEmpty())
        <span class="text-muted">No Pending Application Available</span>
        @else
        <div class="table-responsive-lg">
            <table class="table table-bordered table-sm small">
                <thead class="table-secondary text-center">
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
                                    <a class="dropdown-item" href="{{ route('application.show', $pending)}}">Show</a>

                                    <form action="{{ route('approver.approve', $pending)}}" method="post">
                                        @csrf
                                        @method('GET')
                                        <input class="dropdown-item text-success" role="button" type="submit"
                                            value="Approve">
                                    </form>

                                    <form action="{{ route('approver.reject', $pending)}}" method="post">
                                        @csrf
                                        @method('GET')
                                        <input class="dropdown-item text-danger" role="button" type="submit"
                                            value="Reject">
                                    </form>

                                    <div class="dropdown-divider"></div>

                                    <form action="{{route('application.destroy', $pending)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="dropdown-item text-danger" role="button" type="submit"
                                            value="Delete">
                                    </form>
                                </div>
                            </div>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @if ($pendings->isNotEmpty())
    <div class="card-footer">
        {{ $pendings->links() }}
    </div>
    @endif
</div>

<div class="card shadow-sm border-left-success mb-4">
    <div class="card-header">Approved Application</div>
    <div class="card-body text-center">
        @if ($approved->isEmpty())
        <span class="text-muted">No Approved Application Available</span>
        @else
        <div class="table-responsive-lg">
            <table class="table table-bordered table-sm small">
                <thead class="table-success text-center">
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
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                    data-toggle="dropdown">More</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('application.show', $approve)}}">
                                        Show</a>

                                    <div class="dropdown-divider"></div>

                                    <form action="{{route('application.destroy', $approve)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="dropdown-item text-danger" role="button" type="submit"
                                            value="Delete">
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
        @endif
    </div>
    @if ($approved->isNotEmpty())
    <div class="card-footer">
        {{ $approved->links() }}
    </div>
    @endif
</div>

<div class="card shadow-sm border-left-danger mb-4">
    <div class="card-header">Rejected Application</div>
    <div class="card-body text-center">
        @if ($rejected->isEmpty())
        <span class="text-muted">No Rejected Application Available</span>
        @else
        <div class="table-responsive-lg">
            <table class="table table-bordered table-sm small">
                <thead class="table-danger text-center">
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
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                    data-toggle="dropdown">More</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('application.show', $reject)}}">
                                        Show</a>

                                    <div class="dropdown-divider"></div>

                                    <form action="{{route('application.destroy', $reject)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="dropdown-item text-danger" role="button" type="submit"
                                            value="Delete">
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
        @endif
    </div>
    @if ($rejected->isNotEmpty())
    <div class="card-footer">
        {{ $rejected->links() }}
    </div>
    @endif
</div>


@endsection
