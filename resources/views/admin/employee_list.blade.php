@extends('layouts.wrapper')
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Employee List</h1>
    <form class="form-inline" method="GET" action="{{route('admin.employee_search')}}">
        <input type="text" class="form-control mb-2 mr-sm-2" name="search" placeholder="Search" aria-label="Search"
            value="@if(!empty($query)) {{$query}} @endif">
        <button type="submit" class="btn btn-outline-success mb-2">Search</button>
    </form>
</div>

@include('partials._validation')
@include('partials._notifications')


@if (!$users->isEmpty())
<div class="table-responsive-lg">
    <table class="table table-sm table-bordered table-striped container small">
        <thead class="table-dark">
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
                        <button class="btn btn-primary btn-sm btn-block dropdown-toggle"
                            data-toggle="dropdown">More</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.show', $user->id)}}">Show</a>
                            <a class="dropdown-item text-success" href="{{ route('admin.edit', $user->id)}}">Edit</a>

                            @if($user->emp_status_id != 2)
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('admin.destroy', $user->id)}}" method="POST">
                                @csrf
                                <input class="dropdown-item text-danger" role="button" type="submit" value="Resign"
                                    onclick="return confirm('Resign this employee?');">
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
{{ $users->links() }}
@else
<div class="card">
    <div class="card-body text-center">
        <span>No record found.</span>
    </div>
</div>
@endif


@endsection
