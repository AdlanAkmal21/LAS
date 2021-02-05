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


                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                    <h1 class="h3 mb-0 text-gray-800">Holiday List</h1>
                    <a type="button" class="btn btn-primary btn-sm" href="{{ route('holidays.create') }}">Add
                        Holiday</a>
                </div>

                @include('partials._validation')
                @include('partials._notifications')

                <span>
                    <label for="total_holidays">Total Holidays :</label>
                    <input type="text" class="text-center" size="3" name="total_holidays" disabled
                        value="{{$holidays_count}}">
                </span>


                @if($holidays->isEmpty())
                <div class="card shadow-sm border-left-dark mt-4 mb-4">
                    <div class="card-body text-center">
                        <span class="text-muted">No Application Available</span>
                    </div>
                </div>
                @else
                <div class="table-responsive-lg mt-1">
                    <table class="table table-sm table-bordered table-striped container small">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Holiday Name</th>
                                <th>Holiday Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($holidays as $key => $holiday)
                            <tr>
                                <td>{{ $holidays->firstItem() + $key }}.</td>
                                <td>{{ $holiday->holiday_name }}</td>
                                <td>{{ $holiday->holiday_date }}</td>
                                <td>
                                    <a class="btn btn-success btn-block btn-sm"
                                        href="{{ route('holidays.edit', $holiday->id)}}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('holidays.destroy', $holiday->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger btn-block btn-sm" role="button" type="submit"
                                            value="Delete">
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                {{ $holidays->links() }}
                @endif



            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
