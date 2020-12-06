<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use JavaScript;

use App\Traits\LeaveTrait;
use App\Models\User;


class ReportController extends Controller
{
    use LeaveTrait;

    public function overview()
    {
        $array = $this->dashboardAdmins();

        //Employee
        $employees_count                = $array['employees_count'];   
        $male_count                     = $array['male_count'];
        $female_count                   = $array['female_count'];
        $admin_count                    = $array['admin_count'];
        $employee_count                 = $array['employee_count'];
        $approver_count                 = $array['approver_count'];
        $working_count                  = $array['working_count'];
        $resigned_count                 = $array['resigned_count'];

        //Leave
        $taken_so_far_sum               = $array['taken_so_far_sum'];
        $carry_over_sum                 = $array['carry_over_sum'];
        $balance_leaves_sum             = $array['balance_leaves_sum'];

        $taken_so_far_sum_average       = $array['taken_so_far_sum_average'];
        $annual_e_average               = $array['annual_e_average'];

        //Application
        $applications_count             = $array['applications_count'];
        $applications_this_year_count   = $array['applications_this_year_count'];
        
        $pending_count                  = $array['pending_count'];
        $approve_count                  = $array['approve_count'];
        $reject_count                   = $array['reject_count'];
        $pending_this_year_count        = $array['pending_this_year_count'];
        $approve_this_year_count        = $array['approve_this_year_count'];
        $reject_this_year_count         = $array['reject_this_year_count'];

        
        //Holiday
        $holidays_count                 = $array['holidays_count'];                

        JavaScript::put([
            'male_count'    => $male_count,
            'female_count'  => $female_count,
            'pending_count' =>  $pending_count,
            'approve_count' => $approve_count,
            'reject_count'  => $reject_count,
            'admin_count'   => $admin_count,
            'employee_count'=> $employee_count,
            'approver_count'=> $approver_count,
            'working_count' => $working_count,
            'resigned_count'  => $resigned_count,
            'applications_count' => $applications_count,
            'applications_this_year_count' => $applications_this_year_count,
        ]);

        return view('report.overview', compact(
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

        ));
    }

    public function individual()
    {
        $users = User::join('employee_details','employee_details.user_id','=','users.id')
        ->select('users.*', DB::raw('DATE_FORMAT(employee_details.date_joined, "%d %M, %Y") as date_joined','users.id as userID'))
        ->where('users.id', '!=' , 1)
        ->simplePaginate(10);
        
        return view('report.individualList', compact('users'));
    }

    public function findindividual($id)
    {
        $array                 = $this->employeeShow($id); 
        $array2                = $this->employeeReport($id); 

        $user                  = $array['user'];
        $leave                 = $array['leave'];
        $current_approver_name = $array['current_approver_name'];

        $applications_count    = $array2['applications_count'];
        $applications_this_year_count    = $array2['applications_this_year_count'];
        $pending_count         = $array2['pending_count'];
        $approved_count        = $array2['approved_count'];
        $rejected_count        = $array2['rejected_count'];

        $applications_days_taken_sum        = $array2['applications_days_taken_sum'];
        $applications_days_taken_avg        = $array2['applications_days_taken_avg'];

        JavaScript::put([
            'individual_pending_count' =>  $pending_count,
            'individual_approve_count' => $approved_count,
            'individual_reject_count'  => $rejected_count,
        ]);

        return view('report.individualReport' , compact(
            'user',
            'leave',
            'current_approver_name',
            'applications_count',
            'applications_this_year_count',
            'pending_count',
            'approved_count',
            'rejected_count',
            'applications_days_taken_sum',
            'applications_days_taken_avg',
        ));
    }


}



