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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    if(Auth::user()){
    	return Auth::user()->name();
    }else{
	    return "lll";
    }
});

Auth::routes();

Route::post('/login/student', 'Auth\StudentLoginController@login')->name('student.login');
Route::post('/login/employee', 'Auth\EmployeeLoginController@login')->name('employee.login');
Route::post('/login/admin', 'Auth\AdminLoginController@login')->name('admin.login');

Route::get('/login/student', 'Auth\StudentLoginController@showLoginForm')->name('login.student');
Route::get('/login/employee', 'Auth\EmployeeLoginController@showLoginForm')->name('login.employee');
Route::get('/login/admin', 'Auth\AdminLoginController@showLoginForm')->name('login.admin');

Route::get('/logout/student', 'Auth\StudentLoginController@logout')->name('logout.student');
Route::get('/logout/employee', 'Auth\EmployeeLoginController@logout')->name('logout.employee');
Route::get('/logout/admin', 'Auth\AdminLoginController@logout')->name('logout.admin');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');



Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/student', 'StudentController@index')->name('student.index');
Route::get('/employee', 'EmployeeController@index')->name('employee.index');



// Route::get('/student', function () {
//     return view('home');
// })->name('student.index');










