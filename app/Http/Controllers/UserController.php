<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Traits\LeaveTrait;

class UserController extends Controller
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
        $this->yearlyCarryOver();
        $this->checkPendingApplication();
        $this->yearlyCarryOver(Auth::id());
        $this->off_duty();

        $array              = $this->dashboardEmployees(Auth::id());
        $user               = $array['user'];
        $applications_count = $array['applications_count'];
        $applications_count_this_year = $array['applications_count_this_year'];
        $approvers_pending_count = $array['approvers_pending_count'];

        return view('user.dashboard', compact('user' , 'applications_count','applications_count_this_year','approvers_pending_count'));
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

        return view('user.employee_detail' , compact('user','leave','current_approver_name'));
    }


    public function readNotifications()
    {
        Auth()->user()->unreadNotifications->markAsRead();

        return redirect()->route('users.viewNotifications');
    }

    public function viewNotifications()
    {
       return view('user.notifications',[
           'notifications' => Auth()->user()->notifications()->paginate(5)
       ]);
    }
}
