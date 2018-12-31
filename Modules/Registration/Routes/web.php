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

Route::prefix('registration')->group(function() {
    Route::get('/', 'RegistrationController@index')->name('registration.index');
	
	
	Route::prefix('department')->group(function() {
        Route::get('/group', 'DepartmentController@group')->name('registration.department.group');
        Route::post('/group', 'DepartmentController@group_create')->name('registration.department.group.create');
        
        Route::get('/instructors', 'DepartmentController@instructors')->name('registration.department.instructors');
        Route::get('/students', 'DepartmentController@students')->name('registration.department.students');

		Route::get('/enroll/{group}', 'DepartmentController@enroll')->name('registration.department.enroll');
		Route::post('/enroll', 'DepartmentController@enroll_submit')->name('registration.department.enroll.post');
    });
    Route::prefix('school')->group(function() {
		Route::get('/group', 'SchoolController@group')->name('registration.department.group');
    });
    Route::prefix('admin')->group(function() {
		Route::get('/', 'AdminController@index')->name('registration.admin.index');
		
		Route::get('/group', 'AdminController@group')->name('registration.admin.group');
		Route::post('/group', 'AdminController@group_create')->name('registration.admin.group.create');
		Route::get('/enroll/{group}', 'AdminController@enroll')->name('registration.admin.enroll');
		Route::get('/enroll-detail/{group}', 'AdminController@enroll_detail')->name('registration.admin.enroll-detail');
		Route::post('/enroll', 'AdminController@enroll_submit')->name('registration.admin.enroll.post');
	});
});
