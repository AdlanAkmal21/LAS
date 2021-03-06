@extends('layouts.wrapper')
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">File List</h1>
</div>

@include('partials._validation')
@include('partials._notifications')

<span>
    <label for="files_count">Total Files :</label>
    <input type="text" class="text-center" size="3" id="files_count" name="files_count" disabled
        value="{{$files_count}}">
</span>

@if ($files->isEmpty())
<div class="card shadow-sm border-left-dark mt-2 mb-4">
    <div class="card-body text-center">
        <span class="text-muted">No Files Available</span>
    </div>
</div>
@else
<div class="table-responsive-lg">
    <table class="table table-sm table-bordered table-striped container small">
        <thead class="table-dark text-center">
            <tr class="d-flex">
                <th class="col-1">#</th>
                <th class="col-5">Applicant</th>
                <th class="col-3">Application Type</th>
                <th class="col-3">Attachment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $key => $file)
            <tr class="d-flex">
                <td class="col-1">{{ $files->firstItem() + $key }}.</td>
                <td class="col-5">
                    <a
                        href="{{ route('admin.show', $file->application->user->id)}}">{{ $file->application->user->name}}</a>
                </td>
                <td class="col-3 text-center">
                    <a
                        href="{{ route('application.show', $file->application)}}">{{ $file->application->refLeaveType->leave_type_name}}</a>
                </td>
                <td class="col-3 text-center">
                    <a href="{{asset("storage/$file->filecategory/$file->filename")}}" name="file" id="file"><i
                            class="fa fa-file fa-lg mr-2"></i> {{$file->filename}}</a> </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
{{ $files->links() }}
@endif


@endsection
