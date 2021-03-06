<ul class="navbar-nav bg-gradient-indigo sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <i class="fas fa-laptop-code"></i>
        <div class="sidebar-brand-text mx-3">IGS Protech</div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" @if(Auth::user()->role_id == 1) href="{{ route('admin.index') }}" @else
            href="{{ route('user.index') }}" @endif>
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>


    @if (Auth::user()->role_id == 1)
    <!-- Admin Section -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminReport" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Report</span>
        </a>
        <div id="AdminReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Examples:</h6>
                <a class="collapse-item" href="{{ route('report.overview') }}">Overview Report</a>
                <a class="collapse-item" href="{{ route('report.individual') }}">Individual Report</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminManagement"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Management</span>
        </a>
        <div id="AdminManagement" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Employees:</h6>
                <a class="collapse-item" href="{{ route('admin.create') }}">Add Employee</a>
                <a class="collapse-item" href="{{ route('admin.employee_list') }}">Employee List</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Manage Applications:</h6>
                <a class="collapse-item" href="{{ route('admin.application_list') }}">Applications List (All)</a>
                <h6 class="collapse-header">Manage Holidays:</h6>
                <a class="collapse-item" href="{{ route('holiday.create') }}">Add Holiday</a>
                <a class="collapse-item" href="{{ route('holiday.index') }}">Holiday List</a>
                <h6 class="collapse-header">Manage Files:</h6>
                <a class="collapse-item" href="{{ route('file.index') }}">File List</a>
            </div>
        </div>
    </li>
    @endif


    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
    <!-- Employee Section -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Employee
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('application.create')}}">
            <i class="fas fa-file-signature"></i>
            <span>Apply Leave</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#EmployeeManagement"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-tasks"></i>
            <span>Management</span>
        </a>
        <div id="EmployeeManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Applications:</h6>
                <a class="collapse-item" href="{{ route('application.index')}}">Applications List</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Manage Account:</h6>
                <a class="collapse-item" href="{{ route('user.show', Auth::id())}}">Employee Details</a>
                <a class="collapse-item" href="{{ route('reset.view')}}">Change Password</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('attendance.view')}}">
            <i class="fas fa-fw fa-id-card"></i>
            <span>WFH</span></a>
    </li>
    @endif



    @if (Auth::user()->role_id == 3)
    <!-- Approver Section -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Approver
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ApproverManagement"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Management</span>
        </a>
        <div id="ApproverManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Applicants:</h6>
                <a class="collapse-item" href="{{ route('approver.approver_list', Auth::id()) }}">Approver's List</a>
                <a class="collapse-item" href="{{ route('approver.applicant_list', Auth::id()) }}">Applicants List</a>
            </div>
        </div>
    </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
