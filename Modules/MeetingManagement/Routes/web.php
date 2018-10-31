<?php

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

Route::prefix('meetingmanagement')->group(function() {
    Route::get('/', 'MeetingManagementController@index');
    Route::prefix('employee')->group(function() {
		Route::get('/create', 'EmployeeController@create')->name('meetingmanagement.employee.create');
		Route::post('/create', 'EmployeeController@create_submit')->name('meetingmanagement.employee.create.post');
		Route::post('/add_member', 'EmployeeController@member_add')->name('meetingmanagement.employee.member_add');
		Route::post('/update', 'EmployeeController@update')->name('meetingmanagement.employee.edit');



		Route::get('/meeting/{id}', 'EmployeeController@meeting_single')->name('meetingmanagement.employee.meeting_single');
		Route::get('/meeting/start/{id}', 'EmployeeController@meeting_stop')->name('meetingmanagement.employee.meeting_stop');
		Route::get('/meeting/sign/{id}', 'EmployeeController@meeting_sign')->name('meetingmanagement.employee.meeting.sign');

		Route::post('/meeting/create', 'EmployeeController@meeting_create')->name('meetingmanagement.employee.meeting.create');

		Route::post('/agenda/create', 'EmployeeController@agenda_create')->name('meetingmanagement.employee.agenda.create');
		Route::post('/decision/create', 'EmployeeController@decision_create')->name('meetingmanagement.employee.decision.create');

		Route::get('/group/{id}', 'EmployeeController@group_single')->name('meetingmanagement.employee.group_single');
		Route::get('/mygroups', 'EmployeeController@mygroups')->name('meetingmanagement.employee.mygroups');
	});
});
