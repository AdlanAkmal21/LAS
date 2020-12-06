<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Holiday;

class HolidayController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {             
        $holidays       = Holiday::simplePaginate(5);
        $holidays_count = $holidays->count();
        
        return view('holiday.holidayList', compact('holidays', 'holidays_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holiday.holidayAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'holiday_name'   => ['required', 'string', 'max:255'],
            'holiday_date'   => ['required', 'date'],
        ]);

        $holiday                = new Holiday();
        $holiday->holiday_name  = $request->get('holiday_name');
        $holiday->holiday_date  = $request->get('holiday_date');
        
        $holiday->save();

        return redirect('/admin/holidayadd')->with('success' , 'Holiday added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $holiday        = Holiday::find($id);

        return view('holiday.holidayEdit' , compact('holiday'));
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
            'holiday_name'   => ['required', 'string', 'max:255'],
            'holiday_date'   => ['required', 'date'],
        ]);

        $holiday                = Holiday::find($id);
        $holiday->holiday_name  = $request->get('holiday_name');
        $holiday->holiday_date  = $request->get('holiday_date');
        
        $holiday->save();

        return redirect('/admin/holidaylist')->with('success', 'Holiday Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holiday = Holiday::find($id);
        $holiday->delete();

        return redirect('/admin/holidaylist')->with('error', 'Holiday Deleted.');
    }
}
