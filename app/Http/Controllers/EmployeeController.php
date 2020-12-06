<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


class EmployeeController extends Controller
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

    public function reset(Request $request, $id)
    {
        // $request->validate([
        //     'email'=>'required',
        //     'current_password'=>'required',
        //     'password'=>'required',
        // ]);

        // $user = User::find($id);
        // $email              = $request->get('email');
        // $current_password   = Hash::make($request->get('current_password'));
        // $password           = Hash::make($request->get('password'));

        // if( $user->email == $email)
        // {
        //     if($user->password == $current_password)
        //     {
        //         $user->password = $password;
        //         $user->save();
        //     }
        // }

        // return redirect('reset/{id}')->with('success', 'Password Reset.');
        echo "<h1>Employee Reset</h1>";

    }
}
