@extends('layouts.wrapper')
@section('content')

<div class="card">
    <div class="card-header"><b>{{ __('Edit Holiday') }}</b></div>
    <div class="card-body">
        @include('partials._validation')
        @include('partials._notifications')
        <form method="post" action="{{ route('holiday.update', $holiday) }}">
            @method('PATCH')
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="holiday_name">Holiday Name</label>
                        <input class="form-control" type="text" name="holiday_name" value="{{$holiday->holiday_name}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="holiday_date">Holiday Date</label>
                        <input id="holiday_date" class="form-control" type="text" name="holiday_date"
                            value="{{$holiday->holiday_date}}">
                    </div>
                </div>
            </div>

            <div class="p-t-15">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-danger" href="{{ route('holiday.index')}}">Cancel</a>
            </div>

        </form>
    </div>
</div>


@endsection
