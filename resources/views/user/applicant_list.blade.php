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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Applicant List</h1>
                </div>

                <div class="table-responsive-lg">
                    <table
                        class="table table-bordered table-light table-hover table-striped table-responsive-lg container small">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Role</th>
                                <th>Date Joined</th>
                                <th>Employee Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}.</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->refRole->role_name }}</td>
                                <td>{{ $user->date_joined }}</td>
                                <td>{{ $user->refEmpStatus->emp_status_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}

            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
