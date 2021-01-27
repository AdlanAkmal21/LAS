<?php

namespace App\Traits;
use Carbon\Carbon;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LeaveDetail;
use App\Models\LeaveApplication;
use App\Models\Holiday;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait LeaveTrait{

    //Index
    public function checkPendingApplication()
    {
        if (LeaveApplication::where('to', '<=', Carbon::today())->exists()  ) {
            $applications = LeaveApplication::where('to', '<', Carbon::today())->get();

            foreach($applications as $application){
                if($application->application_status_id == 1)
                {
                    if ($application->leave_type_id == 1) {
                        $application->application_status_id = 3;
                        $application->approval_date         = Carbon::now();
                        $application->save();
                    }
                }
            }
        }
    }

    public function yearlyCarryOver()
    {
        $user = Auth::user();
        $current_year   = Carbon::now()->year;

            if($current_year > $user->employee->last_carry_over)
            {
                    $user->leave->annual_e         = 14;
                    $user->leave->taken_so_far     = 0;
                    $user->leave->carry_over       =  $user->leave->balance_leaves;
                    $user->leave->total_leaves     = ($user->leave->annual_e)+($user->leave->carry_over);
                    $user->leave->balance_leaves   = ($user->leave->total_leaves)-($user->leave->taken_so_far);
                    $user->leave->save();

                    $user->employee->last_carry_over = $current_year;
                    $user->employee->save();
            }

    }

    public function off_duty()
    {
        $today  = Carbon::today()->locale('en_MY');
        $start  = $today->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $end    = $today->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');

        $offduty     = LeaveApplication::join('users','leave_applications.user_id','=','users.id')
                                        ->select('leave_applications.*','users.*','users.id as userID')
                                        ->where(function ($query) use ($start, $end)
                                        {
                                            $query->where('leave_applications.application_status_id', 2)
                                                    ->where('leave_applications.from','>=', $start)
                                                    ->where('leave_applications.from','<=', $end);
                                        })
                                        ->orWhere(function($query) use ($start, $end)
                                        {
                                            $query->where('leave_applications.application_status_id', 2)
                                                    ->where('leave_applications.from','<', $start)
                                                    ->where('leave_applications.to','>', $end);
                                        })
                                        ->orWhere(function($query) use ($start, $today)
                                        {
                                            $query->where('leave_applications.application_status_id', 2)
                                                    ->where('leave_applications.to','>=', $start)
                                                    ->where('leave_applications.to','<', $today);
                                        })
                                        ->paginate(5);


        if (isset($offduty))
        {
            foreach ($offduty as $ofd)
            {   $user = User::find($ofd->userID);

                if($ofd->days_taken < 3)
                {
                    $ofd->user->emp_status_id = 3; //Leave
                }
                else
                {
                    $ofd->user->emp_status_id = 4; //Long Leave
                }
                    $ofd->user->save();
            }
        }

        $ofd_id = $offduty->pluck('userID');
        $users  = User::pluck('id');
        $ond_id = $users->diff($ofd_id);

        if (isset($ond_id))
        {
            foreach ($ond_id as $id) {
                $check = User::find($id);
                if($check->emp_status_id == 3 || $check->emp_status_id == 4)
                {
                    $check->emp_status_id = 1;
                    $check->save();
                }
            }
        }

        $offduty_count      = LeaveApplication::where(function ($query) use ($start, $end)
                                            {
                                                $query->where('application_status_id', 2)
                                                        ->where('from','>=', $start)
                                                        ->where('from','<=', $end);
                                            })
                                            ->orWhere(function($query) use ($start, $end)
                                            {
                                                $query->where('application_status_id', 2)
                                                        ->where('from','<', $start)
                                                        ->where('to','>', $end);
                                            })
                                            ->orWhere(function($query) use ($start, $today)
                                            {
                                                $query->where('application_status_id', 2)
                                                        ->where('to','>=', $start)
                                                        ->where('to','<', $today);
                                            })
                                            ->distinct('user_id')
                                            ->count();

        return compact('offduty','offduty_count');
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
        $servicedays            = ($year_end->diffInDays($date_joined))+1;
        $annual_e               = $servicedays/$DaysperAnnualLeave;

        $rounded                = round($annual_e, 1);	//Round off to nearest 0.0
        $entitlement            = round($rounded); //Round off to whole number

        // //For Pushing Input Into DB (Leaves Table)
        $leave                  = new LeaveDetail();
        $leave->user_id         = $employee->user_id;
        $leave->annual_e        = $entitlement;
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


        $employees_count                = $employees->count();
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

        $monday_count = $tuesday_count = $wednesday_count =
        $thursday_count = $friday_count = $saturday_count = $sunday_count =  0 ;

        $january_count = $february_count = $march_count = $april_count=
        $may_count = $june_count = $july_count = $august_count = $september_count =
        $october_count = $november_count = $december_count = 0;


        foreach($holidays as $holiday){
           $day = Carbon::parse($holiday->holiday_date)->englishDayOfWeek;
           $month = Carbon::parse($holiday->holiday_date)->englishMonth;

           switch ($day) {
               case 'Monday':
                   $monday_count++;
                   break;
               case 'Tuesday':
                   $tuesday_count++;
                   break;
               case 'Wednesday':
                   $wednesday_count++;
                   break;
               case 'Thursday':
                   $thursday_count++;
                   break;
               case 'Friday':
                   $friday_count++;
                   break;
               case 'Saturday':
                   $saturday_count++;
                   break;
               case 'Sunday':
                   $sunday_count++;
                   break;
               default:
                   break;
           }

           switch ($month) {
               case 'January':
                   $january_count++;
                   break;
               case 'February':
                   $february_count++;
                   break;
               case 'March':
                   $march_count++;
                   break;
               case 'April':
                   $april_count++;
                   break;
               case 'May':
                   $may_count++;
                   break;
               case 'June':
                   $june_count++;
                   break;
               case 'July':
                   $july_count++;
                   break;
               case 'August':
                   $august_count++;
                   break;
               case 'September':
                   $september_count++;
                   break;
               case 'October':
                   $october_count++;
                   break;
               case 'November':
                   $november_count++;
                   break;
               case 'December':
                   $december_count++;
                   break;
               default:
                   break;
           }
        }

        $dayarray = array
                (
            'monday_count' => $monday_count,
            'tuesday_count' => $tuesday_count,
            'wednesday_count' => $wednesday_count,
            'thursday_count' => $thursday_count,
            'friday_count' => $friday_count,
            'saturday_count' => $saturday_count,
            'sunday_count' => $sunday_count,
            );


        $montharray = array
                (
            'january_count' => $january_count,
            'february_count' => $february_count,
            'march_count' => $march_count,
            'april_count' => $april_count,
            'may_count' => $may_count,
            'june_count' => $june_count,
            'july_count' => $july_count,
            'august_count' => $august_count,
            'september_count' => $september_count,
            'october_count' => $october_count,
            'november_count' => $november_count,
            'december_count' => $december_count,
            );

        $highest_day_value = max($dayarray);
        $highest_month_value = max($montharray);

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
            'monday_count',
            'tuesday_count',
            'wednesday_count',
            'thursday_count',
            'friday_count',
            'saturday_count',
            'sunday_count',
            'january_count',
            'february_count',
            'march_count',
            'april_count',
            'may_count',
            'june_count',
            'july_count',
            'august_count',
            'september_count',
            'october_count',
            'november_count',
            'december_count',
            'highest_day_value',
            'highest_month_value',
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
