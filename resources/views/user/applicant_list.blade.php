@extends('layouts.wrapper')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Applicant List</h1>
</div>

<div class="table-responsive-lg">
    <table class="table table-bordered table-striped container small">
        <thead class="table-dark">
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


@endsection
