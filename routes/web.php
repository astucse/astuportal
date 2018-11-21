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


Route::get('/', 'HomeController@index')->name('index');
Route::get('/kkk', 'HomeController@kkk')->name('kkk');
Auth::routes();
Route::get('/login', function(){
	return redirect()->route('index');
})->name('login');


Route::get('/user/resetpassword/{type}/{id}','AdminController@reset_password')->name('user.password_reset');



Route::post('/login/student', 'Auth\StudentLoginController@login')->name('student.login');
Route::post('/login/employee', 'Auth\EmployeeLoginController@login')->name('employee.login');
Route::post('/login/admin', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/login/any', 'Auth\LoginController@any_login')->name('any.login');
	
Route::get('/login/student', 'Auth\StudentLoginController@showLoginForm')->name('login.student');
Route::get('/login/employee', 'Auth\EmployeeLoginController@showLoginForm')->name('login.employee');
Route::get('/login/admin', 'Auth\AdminLoginController@showLoginForm')->name('login.admin');

Route::get('/logout/student', 'Auth\StudentLoginController@logout')->name('logout.student');
Route::get('/logout/employee', 'Auth\EmployeeLoginController@logout')->name('logout.employee');
Route::get('/logout/admin', 'Auth\AdminLoginController@logout')->name('logout.admin');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');




Route::get('/student', 'StudentController@index')->name('student.index');
Route::get('/student/profile', 'StudentController@profile')->name('student.profile');
Route::get('/student/image/{id}', 'StudentController@image')->name('student.image');
Route::post('/student/image/upload', 'StudentController@image_upload')->name('student.image.upload');

Route::get('/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/employee/profile', 'EmployeeController@profile')->name('employee.profile');
Route::get('/employee/image/{id}', 'EmployeeController@image')->name('employee.image');
Route::post('/employee/image/upload', 'EmployeeController@image_upload')->name('employee.image.upload');


Route::group(['prefix'=>'department' ], function () {
	Route::get('/', 'DepartmentController@index')->name('department.index');
	Route::get('/users/students', 'DepartmentController@students')->name('department.students.view');
	Route::get('/users/employees', 'DepartmentController@employees')->name('department.employees.view');
});

Route::group(['prefix'=>'school' ], function () {
	Route::get('/', 'SchoolController@index')->name('school.index');
	Route::get('/users/students', 'SchoolController@students')->name('school.students.view');
	Route::get('/users/employees', 'SchoolController@employees')->name('school.employees.view');
});

Route::group(['prefix'=>'admin' ], function () {
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::get('/users/students', 'StudentController@admin_view')->name('admin.students.view');
	Route::get('/users/employees', 'EmployeeController@admin_view')->name('admin.employees.view');
	

	Route::get('/users/employees/export', 'EmployeeController@export')->name('admin.employees.export');
      Route::get('/users/students/export', 'StudentController@export')->name('admin.students.export');

	Route::post('/roles/create', 'AdminController@create_roles')->name('admin.roles.create');
});

// Route::get('/student', function () {
//     return view('home');
// })->name('student.index');










