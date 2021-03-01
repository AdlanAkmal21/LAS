@extends('layouts.wrapper')
@section('content')

@include('partials._validation')
@include('partials._notifications')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Holiday</h1>
    <a type="button" class="btn btn-success btn-sm" href="{{ route('holiday.index') }}">To
        Holiday List</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('holiday.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Holiday Name') }}</label>

                <div class="col-md-6">
                    <input id="holiday_name" type="text" class="form-control" name="holiday_name"
                        placeholder="Enter Holiday Name.." value="{{ old('holiday_name') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Holiday Date') }}</label>

                <div class="col-md-6">
                    <input id="holiday_date" type="text" class="form-control" name="holiday_date"
                        placeholder="Enter Holiday Date.." value="{{ old('holiday_date') }}">
                </div>
            </div>


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <div class="p-t-15">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                        <button type="reset" class="btn btn-danger">
                            {{ __('Clear') }}
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>

@endsection
