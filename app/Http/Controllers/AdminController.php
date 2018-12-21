<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Option;
use App\Models\AssignedRole;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class AdminController extends Controller
{
	public function __construct(){
        $this->middleware('auth:admin');
    }
    public function module_status_toggle($module){
        $module2 = $module;
        $module = \Module::findOrFail($module2);
        if ($module->disabled()) {
            $module->enable();
        } else {
            $module->disable();
        }
        return redirect()->back();
    }
    
    public function reset_password($type,$id){
        $faker = Faker::create();
        $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
        if($type=="student"){
            $u = Student::find($id);
        }else{
            $u = Employee::find($id);
        }
        $u->initial_password = $pass;
        $u->password = Hash::make($pass);
        $u->save();
        return redirect()->back(); 
        
    }
    public function index(){
        return view('admin.index',[
            'students' => Student::all(),
            'employees' => Employee::all(),
            'females' => Student::where(['sex'=>'F'])->count(),
            'males' => Student::where(['sex'=>'M'])->count(),
        ]);
    }

    public function create_roles(Request $request){
    	$role_id = Role::where(['code'=>$request['code']])->first()->id;
    	if(isset($request['staff'])){
    		$role_taker_id = $request['staff'];
    	}

    	$students = $request['students'];
		if($request['rolegiver_type'] == "none"){
    		AssignedRole::create([
	    		'roletaker_id' => $role_taker_id, 
	    		'roletaker_type' => 'employee', 
	    		'role_id' => $role_id
	    	]);
		}else{
    		AssignedRole::create([
	    		'roletaker_id' => $role_taker_id, 
	    		'roletaker_type' => 'employee', 
	    		'rolegiver_id' => $request['rolegiver_id'], 
	    		'rolegiver_type' => $request['rolegiver_type'],
	    		'role_id' => $role_id
	    	]);
    	}
    	
    	return redirect()->back();
    }
}
