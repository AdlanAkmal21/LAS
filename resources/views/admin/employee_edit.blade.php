@extends('layouts.wrapper')
@section('content')


@include('partials._validation')
@include('partials._notifications')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Employee</h1>
</div>

<div class="card">
    <div class="card-body">

        <form method="post" action="{{ route('admin.update', $user->id) }}">
            @method('PATCH')
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="name">Employee Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name', $user->name)}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email', $user->email)}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="phoneNum">Phone Number</label>
                        <input class="form-control" type="text" name="phoneNum" id="phoneNum"
                            data-inputmask="'mask': '+(60)99 999-9999[9]'"
                            value="{{ old('phoneNum', $user->employee->phoneNum)}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="approver_id">Approved By</label>
                        <select class="form-control" name="approver_id">
                            @foreach ($approvers as $approver)
                            <option @if(old('approver_id', $current_approver_id)==$approver->id )
                                selected
                                @endif
                                value="{{$approver->id}}">{{$approver->name}}</option>
                            @endforeach
                            <option @if(old('approver_id', $current_approver_id)==null ) selected @endif value="">None
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="label" for="emp_status_id">Employee Status</label>
                        <select class="form-control" name="emp_status_id">
                            @foreach ($refEmpStatus as $item)
                            <option @if(old('emp_status_id', $user->emp_status_id) == $item->id )
                                selected
                                @endif
                                value="{{$item->id}}">{{$item->emp_status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-t-15">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-danger" href="{{ route('admin.employee_list')}}">Cancel</a>
            </div>

        </form>
    </div>
</div>


@endsection
