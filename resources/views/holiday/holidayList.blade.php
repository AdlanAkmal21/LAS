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
    
    <div class="row">
    <div class="row">
        <div class="col col-md-auto col1">
            <h1>Holiday List</h1>
            <label for="total_holidays">Total Holidays :</label>
            <input type="text" size="3" name="total_holidays" disabled placeholder="{{$holidays_count}}">
        </div>
        <div class="col-lg pt-lg-2 pb-md-2 d-none d-sm-none d-md-block"  >
            <a type="button" class="btn btn-primary" href="{{ route('holidays.create') }}">Add Holiday</a>
        </div>
    </div>
    <table class="table table-dark table-bordered table-hover table-striped table-responsive-lg container">
        <thead>
            <tr>
                <th>#</th>
                <th>Holiday Name</th>
                <th>Holiday Date</th>
                <th colspan=2>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $key => $holiday)
              <tr>
                <td>{{ $holidays->firstItem() + $key }}.</td>
                <td>{{ $holiday->holiday_name }}</td>
                <td>{{ $holiday->holiday_date }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">More</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item text-success" href="{{ route('holidays.edit', $holiday->id)}}">Edit</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-danger" href="{{ route('holidays.destroy', $holiday->id)}}">Delete</a>                          
                        </div>
                    </div>
                </td>
              </tr>
            @endforeach
        </tbody>

        </table>
        {{ $holidays->links() }}
    </div>

@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection