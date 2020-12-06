@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

    @if(session()->has('success'))
    <div class="alert alert-success fade-message">
        {{ session()->get('success') }}
    </div>
    @endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Application List Page</h1>
</div>
 
        <h4 class="text-muted font-weight-lighter pt-2">Active Leave Application</h4>
        <table class="table table-success table-hover container">
        <thead>
            <tr>
                <th>#</th>
                <th>Leave Type</th>
                <th>From</th>
                <th>To</th>
                <th>Applied At</th>
                <th>Status</th>

                <th colspan = 2>Action</th>
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
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">More</button>
                    <div class="dropdown-menu">
                    <a href="{{ route('applications.show', $active->id)}}" class="dropdown-item">Show</a>
                    @if($active->application_status_id == 1)
                    <a href="{{ route('applications.edit', $active->id)}}" class="dropdown-item text-success">Edit</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('applications.destroy', $active->id)}}" class="dropdown-item text-danger" >Delete</a>
                    @endif
                    </div>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        {{ $actives->links() }}

        <h4 class="text-muted font-weight-lighter pt-2">Past Leave Application</h4>
        <table class="table table-active table-hover container">
            <thead>
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
                        <a href="{{ route('applications.show', $past->id)}}" class="btn btn-secondary">Show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pasts->links() }}




@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection
