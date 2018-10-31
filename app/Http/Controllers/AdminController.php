<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Option;
use App\Models\AssignedRole;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index(){
        return view('admin.index');
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
