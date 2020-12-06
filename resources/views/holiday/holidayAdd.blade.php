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
        {{ session()->get('error') }}
    </div>
    @endif

<div class="row">
    <div class="col col-md-auto col1">
        <h2>Add Holiday</h2>
    </div>
    <div class="col-lg pt-lg-2 pb-md-2 d-none d-sm-none d-md-block"  >
        <a type="button" class="btn btn-success btn-sm" href="{{ route('holidays.index') }}">To Holiday List</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('holidays.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Holiday Name') }}</label>

                <div class="col-md-6">
                    <input id="holiday_name" type="text" class="form-control @error('holiday_name') is-invalid @enderror" name="holiday_name" required placeholder="Enter Holiday Name..">

                    @error('holiday_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Holiday Date') }}</label>

                <div class="col-md-6">
                    <input id="holiday_date" type="text" class="form-control @error('holiday_date') is-invalid @enderror" name="holiday_date" required placeholder="Enter Holiday Date..">

                    @error('holiday_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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

@include('components.footer')<!-- Footer -->
</div><!-- End Page Content -->
</div><!-- End Main Content -->
</div><!-- End Content Wrapper -->
</div><!--End Wrapper-->
@endsection