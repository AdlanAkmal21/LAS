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
                    <h1 class="h3 mb-0 text-gray-800">File List</h1>
                </div>

                @include('partials._validation')
                @include('partials._notifications')

                <span>
                    <label for="files_count">Total Files :</label>
                    <input type="text" size="3" id="files_count" name="files_count" disabled value="{{$files_count}}">
                </span>

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
                                        href="{{ route('admins.empshow', $file->application->user->id)}}">{{ $file->application->user->name}}</a>
                                </td>
                                <td class="col-3 text-center">
                                    <a
                                        href="{{ route('applications.show', $file->application->id)}}">{{ $file->application->refLeaveType->leave_type_name}}</a>
                                </td>
                                <td class="col-3 text-center">
                                    <a href="{{asset("storage/$file->filecategory/$file->filename")}}" name="file"
                                        id="file"><i class="fa fa-file fa-lg mr-2"></i> {{$file->filename}}</a> </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                {{ $files->links() }}


            </div><!-- End Page Content -->
        </div><!-- End Main Content -->
        @include('partials._footer')
        <!-- Footer -->
    </div><!-- End Content Wrapper -->
</div>
<!--End Wrapper-->
@endsection
