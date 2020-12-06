@extends('layouts.main')
@section('content')

<div id="wrapper"><!--Start Wrapper-->
@include('components.sidebar')
<div id="content-wrapper" class="d-flex flex-column"><!-- Content Wrapper -->
<div id="content"><!-- Main Content -->
@include('components.topbar')
<div class="container-fluid"><!-- Begin Page Content -->

    <div class="card">
            <div class="card-header"><b>{{ __('Edit Employee') }}</b></div>
                <div class="card-body">

                    <form method="post" action="{{ route('holidays.update', $holiday->id) }}">
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
                                    <input id="holiday_date" class="form-control" type="text" name="holiday_date" value="{{$holiday->holiday_date}}">
                                </div>
                            </div>
                        </div>  

                        <div class="p-t-15">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a class="btn btn-danger" href="{{ route('holidays.index')}}">Cancel</a>
                        </div>
    
                    </form>
                </div>
            </div>
    
    

@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection