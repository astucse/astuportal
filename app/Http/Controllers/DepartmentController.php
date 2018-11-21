<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Option;
use App\Models\AssignedRole;
use App\Models\Employee;
use App\Models\Student;
use Auth;
use App\Helpers\OptionsHelper;

use Modules\Academic\Entities\Group;
class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:employee','departmetHead']);
    }
    public  function index(){
    	return view('department.index');
    }
    public  function students(){
    	// $n  = sizeof(Student::find(96)->enrollments);
    	$institution = Auth::user()->MyInstitution;
    	$g = Group::where([
    		'institution_id'=>$institution->id,'institution_type'=>'Academic\\Department',
    		'semester' => OptionsHelper::current_semester(), 'year' => OptionsHelper::current_year() 
    	])->get();
    	// return $g;
    	// $m
    	// return Student::find(96)->enrollments[$n-1]->group->institution;
    	// return Student::find(96)->enrollments[$n-1]->group->institution_id;
    	// return Student::find(96)->enrollments[$n-1]->group->institution_id;
    	return view('department.students',['students'=>Student::all(), 'groups'=>$g]);
    }
    public  function employees(){
    	return view('department.employees');
    }
}



