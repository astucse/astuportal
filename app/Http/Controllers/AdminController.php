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
use Lava;
use Auth;
use \Khill\Lavacharts\Lavacharts;
use Illuminate\Auth\SessionGuard;
use Modules\Org\Entities\Department;
use Modules\Org\Entities\School;
use Modules\Org\Entities\Office;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('login_as_sth');
    }
    
    public function index(){
        // $student_count = Student::all()->count();
        // $employee_count = Employee::all()->count();
        $lava = new Lavacharts;
        $reasons = $lava->DataTable();
        $reasons->addStringColumn('Reasons')
                ->addNumberColumn('Percent')
                ->addRow(array('Male', Student::where(['sex'=>'M'])->count()))
                ->addRow(array('Female', Student::where(['sex'=>'F'])->count()));
        $lava->DonutChart('STUD_SEX2', $reasons, [
            'title' => 'Sex ratio of students'
        ]);
        $lava->PieChart('STUD_SEX', $reasons, [
            'is3D'                     => true,
            'slices'                   => ["male","female"],   //Arrays of Slice Options
            // 'pieSliceBorderColor'      => 'string',
            // 'pieSliceText'             => 'string',
            // 'pieSliceTextStyle'        => [array],   //TextStyle options
            'pieStartAngle'            => 0,
            'reverseCategories'        => false,
            // 'sliceVisibilityThreshold' => int | float,
            // 'pieResidueSliceColor'     => 'string',
            // 'pieResidueSliceLabel'     => 'string'
        ]);

        $barValues = $lava->DataTable();
        $barValues->addStringColumn('Reasons')
                ->addNumberColumn('Percent')
                ->addRow(array('Male', Student::where(['sex'=>'M'])->count()))
                ->addRow(array('Female', Student::where(['sex'=>'F'])->count()));
        $lava->BarChart('TheBar', $barValues, [
            'annotations'         => ["malee","femalee"],        //Annotation Options
            'axisTitlesPosition'  => 'string',
            // 'barGroupWidth'       => int | 'string'  //As a percent, "33%"
            // 'dataOpacity'         => float,
            // 'enableInteractivity' => bool,
            // 'focusTarget'         => 'string',
            // 'forceIFrame'         => bool,
            // 'hAxes'               => [array],        //Arrays of HorizontalAxis Options
            // 'hAxis'               => [array],        //HorizontalAxis Options
            // 'orientation'         => 'string',
            'isStacked'           => true,
            // 'reverseCategories'   => bool,
            // 'series'              => [array],        //Numerically indexed, arrays of Series Options
            // 'theme'               => 'string',
            // 'vAxis'               => [array],        //VerticalAxis Options
        ]);


        return view('admin.index',[
            'lava' => $lava,
            'stats' => [
                'students_count' => Student::all()->count(),
                'employees_count' => Employee::all()->count(),
            ]
            // 'students' => Student::all(),
            // 'employees' => Employee::all(),
            // 'females' => ,
            // 'males' => Student::where(['sex'=>'M'])->count(),
        ]);
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

    public function roles(){
        return view('admin.roles',['employees'=>Employee::all(), 'students' => Student::all(),'options'=>Option::all(),'roles'=>Role::all(),'schools'=>School::all(),'offices'=>Office::all(),'departments'=>Department::all()]);
    }
    public function create_roles(Request $request){
    	$role_id = Role::where(['code'=>$request['code']])->first()->id;
    	// return $request->all();
        if(isset($request['staff'])){
    		$role_taker_id = $request['staff'];
    	}
        if (!isset($request['roletaker_type'])) {
            $request['roletaker_type'] = "employee";
        }
    	// $students = $request['students'];
		if($request['rolegiver_type'] == "none"){
    		AssignedRole::create([    
	    		'roletaker_id' => $role_taker_id, 
	    		'roletaker_type' => $request['roletaker_type'], 
	    		'role_id' => $role_id
	    	]);
		}else{
    		AssignedRole::create([
	    		'roletaker_id' => $role_taker_id, 
	    		'roletaker_type' => $request['roletaker_type'], 
	    		'rolegiver_id' => $request['rolegiver_id'], 
	    		'rolegiver_type' => $request['rolegiver_type'],
	    		'role_id' => $role_id
	    	]);
    	}
    	return redirect()->back();
    }


    public function login_as_sth($id,$type){
        $x = Auth::guard($type)->loginUsingId($id);
        return redirect()->route('index');
    }
}
