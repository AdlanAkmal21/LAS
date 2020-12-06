@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Applicant List</h1>
</div>

    <table class="table table-dark table-bordered table-hover table-striped table-responsive-lg container">
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
        {{ $users->links() }}


@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection