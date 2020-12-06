@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

        <div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 text-gray-800">Individual Report</h1></div>
                
        <table class="table table-sm table-dark table-bordered table-hover table-striped table-responsive-lg container">
            <thead>
                <tr class="d-flex">
                    <th class="col-1">#</th>
                    <th class="col-5">Employee Name</th>
                    <th class="col-2">Role</th>
                    <th class="col-2">Date Joined</th>
                    <th class="col-2">Employee Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                  <tr class="table-tr d-flex" data-url="{{ route('report.findindividual', $user->id)}}">
                    <td class="col-1">{{ $users->firstItem() + $key }}.</td>
                    <td class="col-5">{{ $user->name }}</td>
                    <td class="col-2">{{ $user->refRole->role_name }}</td>
                    <td class="col-2">{{ $user->date_joined }}</td>
                    <td class="col-2">{{ $user->refEmpStatus->emp_status_name }}</td>

                  </tr>
                @endforeach
            </tbody>
    
            </table>
            {{ $users->links() }}

    
</div>
@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection