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
    


<div class="d-sm-flex align-items-center justify-content-between mb-2">
<h1 class="h3 mb-0 text-gray-800">Employee List</h1>
<a type="button" class="btn btn-primary" href="{{ route('admins.employeeadd') }}">Add Employee</a>
</div>

<span>
    <label for="total_employees">Total Employees :</label>
    <input type="text" size="3" name="total_employees" disabled placeholder="{{$employees_count}}">
</span>

    <table class="table table-sm table-dark table-bordered table-hover table-striped table-responsive-lg container">
        <thead>
            <tr class="d-flex">
                <th class="col-1">#</th>
                <th class="col-4">Employee Name</th>
                <th class="col-2">Role</th>
                <th class="col-2">Date Joined</th>
                <th class="col-2">Employee Status</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
              <tr class="d-flex">
                <td class="col-1">{{ $users->firstItem() + $key }}.</td>
                <td class="col-4">{{ $user->name }}</td>
                <td class="col-2">{{ $user->refRole->role_name }}</td>
                <td class="col-2">{{ $user->date_joined }}</td>
                <td class="col-2">{{ $user->refEmpStatus->emp_status_name }}</td>
                <td class="col-1">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">More</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('admins.show', $user->id)}}">Show</a>
                          <a class="dropdown-item text-success" href="{{ route('admins.edit', $user->id)}}">Edit</a>

                          @if($user->emp_status_id != 2)
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-danger" href="{{ route('admins.delete', $user->id)}}">Resign</a>                          
                          @endif
                        </div>
                    </div>
                </td>
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