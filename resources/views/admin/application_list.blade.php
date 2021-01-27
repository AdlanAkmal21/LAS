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

                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Applications List (All)</h1>
                </div>


                @if($applications->isEmpty())
                <div class="card shadow-sm border-left-warning mt-4 mb-4">
                    <div class="card-body text-center">
                        <span class="text-muted">No Application Available</span>
                    </div>
                </div>
                @else
                <div class="table-responsive-lg mt-3">
                    <table class="table table-sm table-bordered table-striped container small">
                        <thead class="table-dark">
                            <tr class="d-flex">
                                <th class="col-1">#</th>
                                <th class="col-2">Leave Type</th>
                                <th class="col-2">From</th>
                                <th class="col-2">To</th>
                                <th class="col-2">Applied At</th>
                                <th class="col-2">Status</th>
                                <th class="col-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $key => $application)
                            <tr class="d-flex">
                                <td class="col-1">{{ $applications->firstItem() + $key }}.</td>
                                <td class="col-2">{{ $application->refLeaveType->leave_type_name }}</td>
                                <td class="col-2">{{ $application->from }}</td>
                                <td class="col-2">{{ $application->to }}</td>
                                <td class="col-2">{{ $application->created_at }}</td>
                                <td class="col-2">{{ $application->refAppStatus->application_status_name }}</td>
                                <td class="col-1">
                                    <a class="btn btn-primary"
                                        href="{{ route('applications.adminAppShow', $application->leave_applications_id) }}">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $applications->links() }}
                @endif



            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
