<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LeaveDetail;
use App\Models\LeaveApplication;
use App\Models\RefPosition;
use App\Models\RefApplicationStatus;
use App\Models\RefEmpStatus;
use App\Models\RefLeaveType;
use App\Models\Holiday;


trait LeaveTrait{

    //Index
    public function checkPendingApplication() 
    {
        if (LeaveApplication::where('to', '<=', Carbon::today())->exists()  ) {
            $applications = LeaveApplication::where('to', '<', Carbon::today())->get();

            foreach($applications as $application){
                if($application->application_status_id == 1)
                {
                    $application->application_status_id = 3;
                    $application->approval_date         = Carbon::now();
                    $application->save();
                }
            }
        }  
    }

    public function yearlyCarryOver($id) 
    {
        $leave          = LeaveDetail::where('user_id', $id)->first();
        $current_year   = Carbon::now()->year;

        if (isset($leave)) {
            $leave_year     = Carbon::parse($leave->updated_at)->year;

            if ($current_year != $leave_year) {
                $leave->annual_e         = 14;
                $leave->taken_so_far     = 0;
                $leave->carry_over       =  $leave->balance_leaves;
                $leave->total_leaves     = ($leave->annual_e)+($leave->carry_over);
                $leave->balance_leaves   = ($leave->total_leaves)-($leave->taken_so_far);
                $leave->save();
            }
        }



    }

    public function employeeLeaveStatus()
    {
        $offduty                        = User::leftjoin('leave_applications','leave_applications.user_id','=','users.id')
                                                ->select('users.*','leave_applications.*','users.id as userID')
                                                ->where('users.id','!=', 1)
                                                ->where('leave_applications.application_status_id' , 2)
                                                ->where('leave_applications.from','<=',Carbon::today())
                                                ->where('leave_applications.to', '>=', Carbon::today())
                                                ->get();
        if (isset($offduty))
        {
            foreach ($offduty as $off) 
            {
                $user = User::find($off->userID);

                if($off->days_taken < 3)
                {
                    $user->emp_status_id = 3; //Leave
                }
                else
                {
                    $user->emp_status_id = 4; //Long Leave
                }
                
                $user->save();
            }
        }

        if(User::where('emp_status_id',3)->exists())
        {
            $users = User::join('leave_applications','leave_applications.user_id','=','users.id')
                            ->where('users.emp_status_id',3)
                            ->where('leave_applications.from','<=',Carbon::today())
                            ->where('leave_applications.to', '<=', Carbon::today())
                            ->get();

            if(isset($users))
            {
                foreach ($users as $user) 
                {
                    $user->emp_status_id = 1; //Working
                    $user->save();
                }
            }
        }

        if(User::where('emp_status_id',4)->exists())
        {
            $users = User::join('leave_applications','leave_applications.user_id','=','users.id')
                            ->where('users.emp_status_id',4)
                            ->where('leave_applications.from','<=',Carbon::today())
                            ->where('leave_applications.to', '<=', Carbon::today())
                            ->get();

            if(isset($users))
            {
                $user->emp_status_id = 1; //Working
                $user->save();
            }
        }
    }

    //Admin
    public function resignApprover($id)
    {
        $user                   = User::find($id);
        $user->emp_status_id    = 2;

        if($user->position_id == 3)
        {
            $employees   = EmployeeDetail::where('approver_id' , $user->id)->get();
            foreach ($employees as $employee) 
            {
                $employee->approver_id = null;
                $employee->save();            
            }
        }

        $user->save();
    }

    public function employeeShow($id)
    {
        //Validation For Approver's Name
        $user       = User::find($id);
        $leave      = LeaveDetail::where('user_id', $id)->first();

        if($user->employee->approver_id == null)
        {
            $current_approver_name = "None";
        }
        else
        {
            if(User::where('id', $user->employee->approver_id)->exists())
            {
                $current_approver_name = $user->employee->approver->name;
            }
            else
            {
                $user->employee->approver_id = null;
                $user->save();
                $current_approver_name = "None";
            }
        }
        $current_approver_id = $user->employee->approver_id;

        return compact('user', 'leave', 'current_approver_name', 'current_approver_id');
    }

    public function createLeave($id) 
    {
        $employee               = EmployeeDetail::find($id);
        //Calculate Annual Entitlement for New Employees
        $DaysperAnnualLeave     = 365/14;
        $date_joined            = Carbon::parse($employee->date_joined);
        $year_end               = Carbon::parse(Carbon::now()->endOfYear());
        $servicedays            = $year_end->diffInDays($date_joined);
        $annual_e               = $servicedays/$DaysperAnnualLeave;
        // //For Pushing Input Into DB (Leaves Table)
        $leave                  = new LeaveDetail();
        $leave->user_id         = $employee->user_id;
        $leave->annual_e        = $annual_e;
        $leave->carry_over      = 0;
        $leave->taken_so_far    = 0;
        //Calculate Total and Balance Leaves
        $leave->total_leaves    = ($leave->annual_e     + $leave->carry_over);
        $leave->balance_leaves  = ($leave->total_leaves - $leave->taken_so_far);
        //For Pushing Input(Leaves Table)
        $leave->save();
    }

    public function dashboardAdmins()
    {
        //Employees
        $employees                      = User::where('id','!=', 1)->get();
        $resigned                       = User::where('id','!=', 1)
                                                ->where('emp_status_id', 2)
                                                ->get();
        $offduty                        = User::leftjoin('leave_applications','leave_applications.user_id','=','users.id')
                                                ->where('leave_applications.application_status_id' , 2)
                                                ->where('leave_applications.from','<=',Carbon::today())
                                                ->where('leave_applications.to', '>=', Carbon::today())
                                                ->get();
        $employees_count                = $employees->count();
        $offduty_count                  = $offduty->count();
        $male_count                     = EmployeeDetail::where('gender_id',1)->count();
        $female_count                   = EmployeeDetail::where('gender_id',2)->count();
        $admin_count                    = User::where('role_id',1)->count();
        $employee_count                 = User::where('role_id',2)->count();
        $approver_count                 = User::where('role_id',3)->count();

        $working_count                  = User::where('id','!=', 1)->where('emp_status_id',1)->count();
        $resigned_count                 = $resigned->count();   


        //Leave
        $taken_so_far_sum                   = LeaveDetail::sum('taken_so_far');
        $carry_over_sum                     = LeaveDetail::sum('carry_over');
        $balance_leaves_sum                 = LeaveDetail::sum('carry_over');

        $taken_so_far_sum_average           = LeaveDetail::avg('taken_so_far');
        $annual_e_average                   = LeaveDetail::avg('annual_e');

        //Applications
        $applications                   = LeaveApplication::all();
        $applications_count             = $applications->count();
        $applications_this_year         = LeaveApplication::whereYear('created_at', date('Y'))->get();
        $applications_this_year_count   = $applications_this_year->count();
        
        $pending_count                  = LeaveApplication::where('application_status_id',1)->count();
        $approve_count                  = LeaveApplication::where('application_status_id',2)->count();
        $reject_count                   = LeaveApplication::where('application_status_id',3)->count();

        $pending_this_year_count        = LeaveApplication::whereYear('created_at', date('Y'))->where('application_status_id',1)->count();
        $approve_this_year_count        = LeaveApplication::whereYear('created_at', date('Y'))->where('application_status_id',2)->count();
        $reject_this_year_count         = LeaveApplication::whereYear('created_at', date('Y'))->where('application_status_id',3)->count();

        //Holidays
        $holidays                       = Holiday::all();
        $holidays_count                 = $holidays->count();


        return compact(
            'employees',
            'employees_count',
            'male_count',
            'female_count',
            'admin_count',
            'employee_count',
            'approver_count',
            'working_count',
            'resigned_count',
            'offduty', 
            'offduty_count',
            'taken_so_far_sum',
            'carry_over_sum',
            'balance_leaves_sum',
            'taken_so_far_sum_average',
            'annual_e_average',
            'applications_count',
            'applications_this_year_count',
            'pending_count',
            'approve_count',
            'reject_count',
            'pending_this_year_count',
            'approve_this_year_count',
            'reject_this_year_count',
            'holidays_count',
        );
    }

    //Employee & Approver
    public function dashboardEmployees($id)
    {
        $user = User::find($id);
        $applications_count =  LeaveApplication::where('user_id', $id)->count();
        $applications_count_this_year =  LeaveApplication::whereYear('created_at', date('Y'))->where('user_id', $id)->count();
        
        $approvers_pending_count = LeaveApplication::join('employee_details','leave_applications.user_id','=','employee_details.user_id')
                                                    ->select('employee_details.approver_id','leave_applications.*', 'leave_applications.id as applicationID')
                                                    ->where('application_status_id', 1)
                                                    ->where('employee_details.approver_id', $id)
                                                    ->count();

        return compact('user', 'applications_count', 'applications_count_this_year','approvers_pending_count');
    }

    public function employeeReport($id)
    {
        $applications       = LeaveApplication::where('user_id', $id)->get();
        $applications_this_year = LeaveApplication::whereYear('created_at', date('Y'))->where('user_id', $id)->get();
        $applications_count = $applications->count();
        $applications_this_year_count = $applications_this_year->count();

        $pending_count      = $applications->where('application_status_id',1)->count();
        $approved_count     = $applications->where('application_status_id',2)->count();
        $rejected_count     = $applications->where('application_status_id',3)->count();

        $applications_days_taken_sum = $applications->where('application_status_id',2)->sum('days_taken');
        $applications_days_taken_avg = $applications->where('application_status_id',2)->avg('days_taken');

        return compact(
            'applications_count',
            'applications_this_year_count',
            'pending_count',
            'approved_count',
            'rejected_count',
            'applications_days_taken_sum',
            'applications_days_taken_avg',      
        );
    }

}