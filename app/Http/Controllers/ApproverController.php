<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LeaveDetail;
use App\Models\LeaveApplication;
use App\Models\RefRole;
use App\Models\RefApplicationStatus;
use App\Models\RefEmpStatus;
use App\Models\RefLeaveType;

use App\Traits\LeaveTrait;

class ApproverController extends Controller
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
        $this->yearlyCarryOver(Auth::id());

        $array              = $this->dashboardEmployees(Auth::id());
        $user               = $array['user'];
        $applications_count = $array['applications_count'];
        $applications_count_this_year = $array['applications_count_this_year'];
        $approvers_pending_count = $array['approvers_pending_count'];

        return view('employee.dashboard', compact('user' , 'applications_count','applications_count_this_year','approvers_pending_count'));
    }

    public function approverlist($id)
    {
        $approver   = User::find($id);
        $pendings   = LeaveApplication::join('users','leave_applications.user_id','=','users.id')
                                        ->join('employee_details','users.id','=','employee_details.user_id')
                                        ->select('employee_details.*','users.*','leave_applications.*','leave_applications.id as application_id')
                                        ->where('employee_details.approver_id', $approver->id)
                                        ->where('application_status_id', 1)
                                        ->simplePaginate(5);

        return view('employee.approversList', compact('pendings'));
    }

    public function applicantlist($id)
    {
        $approver = User::find($id);
        $users = User::join('employee_details','employee_details.user_id','=','users.id')
                                    ->where('approver_id' , $approver->id )
                                    ->simplePaginate(5);

        return view('employee.applicantList', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('employee.employeeDetail' , compact('user','leave','current_approver_name'));
    }


    public function approve($app_id)
    {
        // dd($app_id);
        $application                           = LeaveApplication::find($app_id); //$app_id is Application ID
        $application->application_status_id    = 2;
        $application->approval_date            = Carbon::now();
        $application->save();

        if ($application->leave_type_id != 2 &&  $application->leave_type_id != 4) { //Except Medical and Unrecorded Leave
            $leave                                 = LeaveDetail::find($application->leave_id);
            $new_balance_leaves                    = ($leave->balance_leaves)-($application->days_taken);
            $leave->balance_leaves                 = $new_balance_leaves;
            $leave->taken_so_far                   += $application->days_taken;
    
            $leave->save();        
        }
 
        return redirect(url()->previous())->with('success', 'Application approved.');
    }

    public function reject($app_id)
    {
        $application                        = LeaveApplication::find($app_id);
        $application->application_status_id = 3;
        $application->approval_date         = Carbon::now();
        $application->save();
        
        return redirect(url()->previous())->with('error', 'Application rejected.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reset($id)
    {
        echo "<h1>Approver Reset</h1>";
        // return ("Approver" . $id);
    }
}
