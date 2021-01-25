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

                @include('partials._validation')
                @include('partials._notifications')

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Application List Page</h1>
                </div>

                @isset(Auth::user()->leave)

                <div class="card shadow-sm border-left-success mb-4">
                    <div class="card-header">Active Leave Application</div>
                    <div class="card-body text-center">
                        @if($actives->isEmpty())

                        <span class="text-muted">No Active Leave Available</span>

                        @else
                        <div class="table-responsive-lg">
                            <table class="table table-bordered table-sm">
                                <thead class="table-success">
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Applied At</th>
                                        <th>Status</th>

                                        <th colspan=2>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($actives as $key => $active)
                                    <tr>
                                        <td>{{ $actives->firstItem() + $key }}.</td>
                                        <td>{{ $active->refLeaveType->leave_type_name }}</td>
                                        <td>{{ $active->from }}</td>
                                        <td>{{ $active->to }}</td>
                                        <td>{{ $active->created_at }}</td>
                                        <td>{{ $active->refAppStatus->application_status_name }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                    data-toggle="dropdown">More</button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('applications.show', $active->id)}}"
                                                        class="dropdown-item">Show</a>
                                                    @if($active->application_status_id == 1)
                                                    <a href="{{ route('applications.edit', $active->id)}}"
                                                        class="dropdown-item text-success">Edit</a>
                                                    <div class="dropdown-divider"></div>

                                                    <form action="{{ route('applications.destroy', $active->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="dropdown-item text-danger" role="button"
                                                            type="submit" value="Delete">
                                                    </form>
                                                    @endif
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
                    @if ($actives->isNotEmpty())
                    <div class="card-footer">{{ $actives->links() }}</div>
                    @endif
                </div>

                <div class="card shadow-sm border-left-secondary mb-4">
                    <div class="card-header">Past Leave Application</div>
                    <div class="card-body text-center">
                        @if($pasts->isEmpty())
                        <span class="text-muted">No Past Leave Available</span>
                        @else
                        <div class="table-responsive-lg">
                            <table class="table table-bordered table-sm">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Applied At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pasts as $key => $past)
                                    <tr>
                                        <td>{{ $pasts->firstItem() + $key }}.</td>
                                        <td>{{ $past->refLeaveType->leave_type_name }}</td>
                                        <td>{{ $past->from }}</td>
                                        <td>{{ $past->to }}</td>
                                        <td>{{ $past->created_at }}</td>
                                        <td>{{ $past->refAppStatus->application_status_name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                    data-toggle="dropdown">More</button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('applications.show', $past->id)}}"
                                                        class="dropdown-item">Show</a>
                                                    @if ($past->application_status_id == 1 && $past->leave_type_id != 1)
                                                    <a href="{{ route('applications.edit', $past->id)}}"
                                                        class="dropdown-item text-success">Edit</a>
                                                    @endif
                                                    @if ($past->leave_type_id != 1 && $past->application_status_id != 3)
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('applications.destroy', $past->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="dropdown-item text-danger" role="button"
                                                            type="submit" value="Delete">
                                                    </form>
                                                    @endif
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
                    @if ($pasts->isNotEmpty())
                    <div class="card-footer">{{ $pasts->links() }}</div>
                    @endif
                </div>

                <div class="card shadow-sm border-left-warning mb-4">
                    <div class="card-header">Medical Leave Application</div>
                    <div class="card-body text-center">
                        @if($medicals->isEmpty())
                        <span class="text-muted">No Medical Leave Available</span>
                        @else
                        <div class="table-responsive-lg">
                            <table class="table table-bordered table-sm">
                                <thead class="table-warning">
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Applied At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicals as $key => $medical)
                                    <tr>
                                        <td>{{ $medicals->firstItem() + $key }}.</td>
                                        <td>{{ $medical->refLeaveType->leave_type_name }}</td>
                                        <td>{{ $medical->from }}</td>
                                        <td>{{ $medical->to }}</td>
                                        <td>{{ $medical->created_at }}</td>
                                        <td>{{ $medical->refAppStatus->application_status_name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                                                    data-toggle="dropdown">More</button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('applications.show', $medical->id)}}"
                                                        class="dropdown-item">Show</a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('applications.destroy', $medical->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="dropdown-item text-danger" role="button"
                                                            type="submit" value="Delete">
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
                    @if ($medicals->isNotEmpty())
                    <div class="card-footer">{{ $medicals->links() }}</div>
                    @endif
                </div>


                @endisset
                @empty(Auth::user()->leave)
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h4 class="display-6" style="text-align: center;">
                            Leave Record is Not Found!
                        </h4>
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
