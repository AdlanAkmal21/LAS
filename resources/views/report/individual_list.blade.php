@extends('layouts.wrapper')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Individual Report</h1>
    <form class="form-inline" method="GET" action="{{route('report.employee_search')}}">
        <input type="text" class="form-control mb-2 mr-sm-2" name="search" placeholder="Search" aria-label="Search"
            value="@if(!empty($query)) {{$query}} @endif">
        <button type="submit" class="btn btn-outline-success mb-2">Search</button>
    </form>
</div>



<div class="table-responsive-lg">
    <table class="table table-sm small table-bordered table-striped table-responsive-lg">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Role</th>
                <th>Employee Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td>{{ $users->firstItem() + $key }}.</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->refRole->role_name }}</td>
                <td>{{ $user->refEmpStatus->emp_status_name }}</td>
                <td>
                    <a href="{{ route('report.view_individual', $user->id)}}" class="btn btn-primary btn-sm btn-block">
                        Show
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
{{ $users->links() }}


@endsection
