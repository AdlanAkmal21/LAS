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

    @if(session()->has('error'))
    <div class="alert alert-warning fade-message">
        <b style="font-size:18px">
        {{ session()->get('error') }}
        </b>
    </div>
    @endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Pending Application</h1>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-active table-hover container">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Days Taken</th>
                    <th>Reason</th>
                    <th>Applied At</th>

                    <th colspan = 2>Action</th>
                </tr>
            </thead>
            <tbody>

                @isset($pendings)
                    @foreach($pendings as $key => $pending)
                    <tr>
                        <td>{{ $pendings->firstItem() +$key }}.</td>
                        <td>{{ $pending->user->name }}</td>
                        <td>{{ $pending->refLeaveType->leave_type_name }}</td>
                        <td>{{ $pending->from }}</td>
                        <td>{{ $pending->to }}</td>
                        <td>{{ $pending->days_taken }}</td>
                        <td>{{ $pending->reason }}</td>
                        <td>{{ $pending->created_at }}</td>
                        <td>
                            <form action="{{ route('approvers.approve', $pending->application_id)}}" method="post"> 
                                @csrf
                                @method('GET')
                                <button class="btn btn-success" type="submit">Approve</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('approvers.reject', $pending->application_id)}}" method="post"> 
                                @csrf
                                @method('GET')
                                <button class="btn btn-danger" type="submit">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endisset
            </tbody>
            </table>
            {{ $pendings->links() }}

    </div>
</div>


@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection