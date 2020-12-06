<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Default
Route::get('/', function () { return view('auth.login'); });

//Authentications
Auth::routes();

//Resources
Route::resource('admins', 'App\Http\Controllers\AdminController')->middleware('role:1');
Route::resource('employees', 'App\Http\Controllers\EmployeeController')->middleware('role:2');
Route::resource('approvers', 'App\Http\Controllers\ApproverController')->middleware('role:3');
Route::resource('applications', 'App\Http\Controllers\ApplicationController');
Route::resource('holidays', 'App\Http\Controllers\HolidayController');

//Holiday

//Applications
Route::get('application/apply', 'App\Http\Controllers\ApplicationController@create')->name('applications.create');
Route::get('application/adminshow/{id}','App\Http\Controllers\ApplicationController@adminAppShow')->name('applications.adminAppShow');
Route::get('application/list','App\Http\Controllers\ApplicationController@list')->name('applications.list');
Route::get('application/delete/{id}','App\Http\Controllers\ApplicationController@destroy')->name('applications.destroy');


//Admins
Route::get('admin/holidayadd','App\Http\Controllers\HolidayController@create')->name('holidays.create');
Route::get('admin/holidaylist','App\Http\Controllers\HolidayController@index')->name('holidays.index');
Route::get('admin/holidayedit/{id}','App\Http\Controllers\HolidayController@edit')->name('holidays.edit');
Route::get('admin/holidaylist/delete/{id}','App\Http\Controllers\HolidayController@destroy')->name('holidays.destroy');
Route::get('report/overview', 'App\Http\Controllers\ReportController@overview')->name('report.overview');
Route::get('report/individual', 'App\Http\Controllers\ReportController@individual')->name('report.individual');
Route::get('report/individual/{id}', 'App\Http\Controllers\ReportController@findindividual')->name('report.findindividual');


Route::get('admin/employeeadd','App\Http\Controllers\AdminController@employeeadd')->name('admins.employeeadd');
Route::get('admin/employeelist','App\Http\Controllers\AdminController@employeelist')->name('admins.employeelist');
Route::get('admin/applicationlist','App\Http\Controllers\AdminController@applicationlist')->name('admins.applicationlist');
Route::get('admin/employeelist/delete/{id}','App\Http\Controllers\AdminController@destroy')->name('admins.delete');

//Approvers
Route::get('approver/approverlist/{id}','App\Http\Controllers\ApproverController@approverlist')->name('approvers.approverlist');
Route::get('approver/applicantlist/{id}','App\Http\Controllers\ApproverController@applicantlist')->name('approvers.applicantlist');
Route::get('approver/approve/{id}', 'App\Http\Controllers\ApproverController@approve')->name('approvers.approve');
Route::get('approver/reject/{id}', 'App\Http\Controllers\ApproverController@reject')->name('approvers.reject');

//Employees
Route::get('employee/employeedetail/{id}', 'App\Http\Controllers\EmployeeController@show')->name('employees.show');

//Password Reset
Route::get('reset/{id}', function () {return view('employee.reset');})->name('resetPage');
Route::get('approver/reset/{id}','App\Http\Controllers\ApproverController@reset')->name('approvers.reset');
Route::get('employee/reset/{id}','App\Http\Controllers\EmployeeController@reset')->name('employees.reset');
