@extends('layouts.wrapper')
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Holiday List</h1>
    <a type="button" class="btn btn-primary btn-sm" href="{{ route('holiday.create') }}">Add
        Holiday</a>
</div>

@include('partials._validation')
@include('partials._notifications')

<span>
    <label for="total_holidays">Total Holidays :</label>
    <input type="text" class="text-center" size="3" name="total_holidays" disabled value="{{$holidays_count}}">
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
                    <a class="btn btn-success btn-block btn-sm" href="{{ route('holiday.edit', $holiday)}}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('holidays.destroy', $holiday)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger btn-block btn-sm" role="button" type="submit" value="Delete">
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
{{ $holidays->links() }}
@endif



@endsection
