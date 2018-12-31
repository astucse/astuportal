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

Route::prefix('org')->group(function() {
    Route::get('/', 'OrgController@index')->name('org.index');
	
	// Route::prefix('department')->group(function() {
	// });
	
	Route::prefix('admin')->group(function() {
		Route::get('/', 'AdminController@index')->name('org.admin.index');
		Route::get('/office', 'AdminController@office')->name('org.admin.office');
		Route::post('/office/create', 'AdminController@office_create')->name('org.admin.office.create');
		// Route::get('/department', 'AdminController@department')->name('org.admin.department');
		Route::post('/school', 'AdminController@school_submit')->name('org.admin.school.post');
		Route::post('/department', 'AdminController@department_submit')->name('org.admin.department.post');
	});
});
