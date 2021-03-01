@extends('layouts.wrapper')
@section('content')


@include('partials._validation')
@include('partials._notifications')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
    <a type="button" class="btn btn-success btn-sm" href="{{ route('admin.employee_list') }}">To
        Employees List</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter Employee Name.."
                        value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email.."
                        value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="ic" class="col-md-4 col-form-label text-md-right">{{ __('IC Number') }}</label>

                <div class="col-md-6">
                    <input id="ic" data-inputmask="'mask': '999999-99-9999'" type="text" class="form-control" name="ic"
                        placeholder="Enter IC Number.." value="{{ old('ic') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="phoneNum" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                <div class="col-md-6">
                    <input id="phoneNum" data-inputmask="'mask': '+(60)99 999-9999[9]'" type=" tel" class="form-control"
                        name="phoneNum" placeholder="Enter Phone Number.." value="{{ old('phoneNum') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="date_joined" class="col-md-4 col-form-label text-md-right">{{ __('Date Joined') }}</label>

                <div class="col-md-6">
                    <input id="date_joined" type="text" class="form-control" name="date_joined"
                        value="{{ old('date_joined') }}" placeholder="Select Date Joined..">
                </div>
            </div>

            <div class="form-group row">
                <label for="gender_id" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">

                    <select class="form-control" name="gender_id">
                        <option selected disabled>Select Gender</option>
                        @foreach ($genders as $gender)
                        <option @if(old('gender_id')==$gender->id ) selected @endif
                            value="{{$gender->id}}">{{$gender->gender_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="role_id">
                        <option selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                        <option @if(old('role_id')==$role->id ) selected @endif
                            value="{{$role->id}}">{{$role->role_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="approver_id" class="col-md-4 col-form-label text-md-right">{{ __('Approved By') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="approver_id">
                        <option selected disabled>Select Approver</option>
                        <option value="">None</option>
                        @foreach ($approvers as $approver)
                        <option @if(old('approver_id')==$approver->id ) selected @endif
                            value="{{$approver->id}}">{{$approver->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <div class="p-t-15">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
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
