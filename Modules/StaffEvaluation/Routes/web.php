<?php

Route::prefix('staffevaluation')->group(function() {
    Route::get('/', 'StaffEvaluationController@index');

	Route::prefix('admin')->group(function() {
		//  
		Route::get('/', 'AdminController@index')->name('staffevaluation.admin.index');
		Route::get('/evaluations', 'AdminController@evaluations')->name('staffevaluation.admin.evaluations');
		Route::get('/sessions', 'AdminController@sessions')->name('staffevaluation.admin.sessions');
		Route::get('/evaluation/{id}', 'AdminController@evaluation_single')->name('staffevaluation.admin.evaluation_single');


		//
		Route::post('/good_bad/update', 'AdminController@good_bad_update')->name('options.staffevaluation.good_bad_points');

		Route::post('/questions/add', 'AdminController@question_create')->name('staffevaluation.admin.question.create');

		Route::post('/evaluations', 'AdminController@evaluations_create')->name('staffevaluation.admin.evaluations.create');
		Route::post('/sessions', 'AdminController@sessions_create')->name('staffevaluation.admin.sessions.create');
		Route::get('/session/{id}', 'AdminController@session_single')->name('staffevaluation.admin.session_single');


		Route::get('/evaluation/{id}/{action}', 'AdminController@evaluation_toggle')->name('staffevaluation.admin.evaluation_toggle');
		

		Route::get('/setting', 'AdminController@setting')->name('staffevaluation.admin.setting');
		Route::post('/setting/equation', 'AdminController@equation_update')->name('staffevaluation.admin.quation.update');
	});

	Route::prefix('student')->group(function() {
		Route::get('/evaluations', 'StudentController@evaluations')->name('staffevaluation.student.evaluations');
		Route::get('/evaluations/{id}', 'StudentController@evaluations_single')->name('staffevaluation.student.evaluations_single');

		Route::post('/evaluate', 'StudentController@evaluate')->name('staffevaluation.student.evaluate');
	});

	Route::prefix('employee')->group(function() {
		Route::get('/myevaluations', 'EmployeeController@myevaluations')->name('staffevaluation.collegue.myevaluations');
		Route::get('/myevaluation/{id}', 'EmployeeController@myevaluation_single')->name('staffevaluation.employee.myevaluation_single');
		//
		Route::get('/evaluations', 'EmployeeController@evaluations')->name('staffevaluation.collegue.evaluations');
		Route::get('/evaluations/{id}', 'EmployeeController@evaluations_single')->name('staffevaluation.collegue.evaluations_single');

		Route::post('/evaluate', 'EmployeeController@evaluate')->name('staffevaluation.collegue.evaluate');
	});
	
	Route::prefix('department')->group(function() {
		//  
		Route::get('/', 'DepartmentController@index')->name('staffevaluation.department.index');
		Route::get('/evaluations', 'DepartmentController@evaluations')->name('staffevaluation.department.evaluations');
		Route::get('/evaluation/{id}', 'DepartmentController@evaluation_single')->name('staffevaluation.department.evaluations_single');

		Route::post('/evaluate', 'DepartmentController@evaluate')->name('staffevaluation.head.evaluate');

		Route::get('/evaluation_sessions', 'DepartmentController@evaluation_sessions')->name('staffevaluation.department.evaluation_sessions');

		// 
		Route::post('/sessions', 'DepartmentController@sessions_create')->name('staffevaluation.department.sessions.create');

		Route::get('/session/{id}', 'DepartmentController@session_single')->name('staffevaluation.department.session_single');
		Route::get('/evaluation/{id}/{action}', 'DepartmentController@evaluation_toggle')->name('staffevaluation.department.evaluation_toggle');
	});
		
});
