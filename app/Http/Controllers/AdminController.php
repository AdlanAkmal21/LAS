<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use JavaScript;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LeaveDetail;
use App\Models\LeaveApplication;
use App\Models\RefRole;
use App\Models\RefApplicationStatus;
use App\Models\RefEmpStatus;
use App\Models\RefLeaveType;
use App\Models\RefGender;
use App\Models\Holiday;


use App\Traits\LeaveTrait;

class AdminController extends Controller
{
    use LeaveTrait;

        /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPendingApplication();
        $this->employeeLeaveStatus();
        $array = $this->dashboardAdmins();

        $employees_count                = $array['employees_count'];   
        $applications_count             = $array['applications_count'];      
        $applications_this_year_count   = $array['applications_this_year_count'];  
        $holidays_count                 = $array['holidays_count'];                
        $resigned_count                 = $array['resigned_count' ];               
        $taken_so_far_sum               = $array['taken_so_far_sum'];
        $offduty                        = $array['offduty'];
        $offduty_count                  = $array['offduty_count'];


        return view('admin.dashboard', 
        compact(
            'offduty',
            'offduty_count',
            'employees_count',
            'applications_count',
            'applications_this_year_count',
            'taken_so_far_sum',
            'holidays_count',
            'resigned_count'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeelist()
    {
        $users = User::join('employee_details','employee_details.user_id','=','users.id')
        ->select('users.*', DB::raw('DATE_FORMAT(employee_details.date_joined, "%d %M, %Y") as date_joined'))
        ->where('users.id', '!=' , 1)
        ->simplePaginate(10);
        

        $array              = $this->dashboardAdmins();
        $employees_count    = $array['employees_count']; 

        return view('admin.employeeList', compact('users','employees_count'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicationlist()
    {   
        $applications = LeaveApplication::join('users','leave_applications.user_id','=','users.id')
                                        ->select('leave_applications.*','users.name', 'leave_applications.id as leave_applications_id')
                                        ->where('users.id','!=',1)
                                        ->simplePaginate(10);
        return view('admin.applicationList', compact('applications'));
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeadd()
    {
        $approvers  = User::where('role_id', 3)->where('emp_status_id', 1)->get();
        $roles      = RefRole::where('id', '!=' , 1)->get();
        $genders    = RefGender::all();


        return view('admin.employeeAdd', compact('approvers','roles','genders'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ic'            => ['required', 'string', 'max:14', 'unique:employee_details'],
            'phoneNum'      => ['required', 'string', 'max:255'],
            'date_joined'   => ['required', 'date'],
            'role_id'       => ['required', 'integer'],
            'gender_id'     => ['required', 'integer'],

        ]);
        
            $user                    = new User();
            $user->name              = $request->get('name');
            $user->email             = $request->get('email');
            $user->role_id           = $request->get('role_id');
            $user->password          = Hash::make("igsprotech2020");
            $user->emp_status_id     = 1;
            $user->save();
    
            $employee                = new EmployeeDetail();
            $employee->user_id       = $user->id;
            $employee->phoneNum      = $request->get('phoneNum');
            $employee->ic            = $request->get('ic');
            $employee->gender_id     = $request->get('gender_id');
            $employee->date_joined   = Carbon::createFromFormat('d/m/Y', $request->get('date_joined'))->format('Y-m-d');
            $employee->approver_id   = $request->get('approver_id');
            $employee->save();
    
            $this->createLeave($employee->id);
    
            return redirect('/admin/employeeadd')->with('success' , 'Employee added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $array                 = $this->employeeShow($id); 
        $user                  = $array['user'];
        $leave                 = $array['leave'];
        $current_approver_name = $array['current_approver_name'];
        
        return view('admin.employeeShow' , compact('user','leave','current_approver_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user                   = User::find($id);
        $approvers              = User::where('role_id', 3)
                                      ->where('emp_status_id', 1)    
                                      ->get();
        $refEmpStatus           = RefEmpStatus::get();

        $array                  = $this->employeeShow($id); 
        $current_approver_id    = $array['current_approver_id'];
        $current_approver_name  = $array['current_approver_name'];

        return view('admin.employeeEdit', compact('user','approvers','refEmpStatus','current_approver_id' , 'current_approver_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phoneNum'=>'required',
            'emp_status_id'=>'required',
        ]);

        $user                           = User::find($id);
        $employee                       = EmployeeDetail::where('user_id', $id)->first();

        $user->name                     = $request->get('name');
        $user->email                    = $request->get('email');
        $user->emp_status_id            = $request->get('emp_status_id');

        $employee->phoneNum             = $request->get('phoneNum');
        $employee->approver_id          = $request->get('approver_id');

        $user->save();
        $employee->save();

        return redirect('/admin/employeelist')->with('success', 'Employee Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->resignApprover($id);
        
        return redirect('/admin/employeelist')->with('error', 'Employee Resigned.');
    }
}
