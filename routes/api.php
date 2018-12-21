<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Employee;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/uuu', function (){
	$students = Student::all();
	$dd = [];
	foreach ($students as $k=>$student) {
		array_push($dd, [
			'pk'=>($k+1),
			// 'name'=>$student->name,
			"fields" => [
				"first_name" => explode(" ", $student->name)[0],
				"last_name" => explode(" ", $student->name)[1]
			],
			"model" =>"myapp.person",

		]);
	}
	return response()->json($dd);
});
