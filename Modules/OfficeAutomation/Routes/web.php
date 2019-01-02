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

Route::prefix('officeautomation')->group(function() {
    Route::get('/', 'OfficeAutomationController@index');
	

	Route::prefix('letter')->group(function() {
    	Route::get('/view/{id}', 'OfficeAutomationController@letter')->name('officeautomation.letter.view');
	});
	Route::prefix('employee')->group(function() {
    	Route::get('/letter/new', 'EmployeeController@new_letter');
    	Route::get('/letter/view/{id}', 'EmployeeController@view_letter')->name('officeautomation.employee.view_letter');

    	Route::get('/letter/single/{id}', 'EmployeeController@single_letter')->name('officeautomation.employee.single_letter');
    	Route::post('/letter/single/update', 'EmployeeController@update_letter')->name('officeautomation.employee.update_letter');
    	Route::post('/letter/create', 'EmployeeController@submit_letter')->name('officeautomation.employee.submit_letter');

    	Route::get('/letter/outbox', 'EmployeeController@outbox_letter');
    	Route::get('/letter/inbox', 'EmployeeController@inbox_letter');

    	// 
	});
});
