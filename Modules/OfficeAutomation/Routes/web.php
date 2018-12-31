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
	

	Route::prefix('employee')->group(function() {
    	Route::get('/letter/new', 'EmployeeController@new_letter');
    	Route::get('/letter/all', 'EmployeeController@all_letter');
	});
});
