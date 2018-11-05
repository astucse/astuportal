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

Route::prefix('academic')->group(function() {
    Route::get('/', 'AcademicController@index')->name('academic.index');
	
	Route::prefix('admin')->group(function() {
		Route::get('/', 'AdminController@index')->name('academic.admin.index');
		
		Route::get('/school', 'AdminController@school')->name('academic.admin.school');
		Route::get('/department', 'AdminController@department')->name('academic.admin.department');
		Route::get('/group', 'AdminController@group')->name('academic.admin.group');
		Route::get('/enroll/{group}', 'AdminController@enroll')->name('academic.admin.enroll');
		Route::get('/enroll-detail/{group}', 'AdminController@enroll_detail')->name('academic.admin.enroll-detail');

		Route::post('/school', 'AdminController@school_submit')->name('academic.admin.school.post');
		Route::post('/department', 'AdminController@department_submit')->name('academic.admin.department.post');
		// Route::post('/group', 'AdminController@group_submit')->name('academic.admin.group.post');
		Route::post('/enroll', 'AdminController@enroll_submit')->name('academic.admin.enroll.post');
		Route::post('/group', 'AdminController@group_create')->name('academic.admin.group.create');


		Route::get('/schedule/{id}', 'AdminController@schedule')->name('academic.admin.schedule');
		
		Route::get('/curriculum', 'AdminController@curriculum')->name('academic.admin.curriculum');
		Route::get('/curriculum/{id}', 'AdminController@curriculum_single')->name('academic.admin.curriculum_single');
		Route::get('/course/export', 'AdminController@course_export')->name('academic.admin.course.export');

		Route::post('/breakdown/course/add', 'AdminController@breakdown_course_add')->name('academic.admin.breakdown.course.add');
		Route::post('/breakdown/elective/add', 'AdminController@breakdown_elective_add')->name('academic.admin.breakdown.elective.add');
		/////////////////////////////////////////////////////////////
		Route::post('/momomomomomo', 'AdminController@momomo')->name('momomo');
		// Route::get('/', 'AcademicController@index')->name('academic.admin.index');


		Route::get('/course', 'AdminController@course')->name('academic.admin.course');


		Route::get('/instructors', 'AdminController@instructors')->name('academic.admin.instructors');
	});
});
