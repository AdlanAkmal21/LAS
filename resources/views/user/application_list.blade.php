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
                    <h1 class="h3 mb-0 text-gray-800">Application List</h1>
                </div>
                <p>Click on the row to view application details.</p>

                <div class="table-responsive-md">
                    <table
                        class="table table-sm table-dark table-bordered table-hover table-responsive-lg container small">
                        <thead>
                            <tr class="d-flex">
                                <th class="col-1">#</th>
                                <th class="col-4">Employee Name</th>
                                <th class="col-2">Leave Type</th>
                                <th class="col-3">Applied At</th>
                                <th class="col-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $key => $application)
                            <tr class="table-tr d-flex"
                                data-url="{{ route('applications.adminAppShow', $application->leave_applications_id) }}">
                                <td class="col-1">{{ $applications->firstItem() + $key }}.</td>
                                <td class="col-4">{{ $application->user->name }}</td>
                                <td class="col-2">{{ $application->refLeaveType->leave_type_name }}</td>
                                <td class="col-3">{{ $application->created_at }}</td>
                                <td class="col-2">{{ $application->refAppStatus->application_status_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $applications->links() }}
                </div>

            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
