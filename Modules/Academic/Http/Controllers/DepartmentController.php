<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Role;
use App\Models\Option;
use App\Models\AssignedRole;
use App\Models\Employee;
use App\Models\Student;
use Auth;
use App\Helpers\OptionsHelper;
use Modules\Academic\Entities\Group;
use Modules\Academic\Entities\Assignment;
use Modules\Academic\Entities\CourseBreakdown;

class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:employee','departmetHead']);
    }
    public function instructors_assign_api(Request $request){
        // return ;
        $institution = Auth::user()->MyInstitution;
    	Assignment::create([
            'batch_year' => $request['year'], 
            'institution_id' => $institution->id, 
            'institution_type' => 'Academic\\Department',
    		'academic_year' => OptionsHelper::current_year(),
    		'semester' => OptionsHelper::current_semester(),
    		'course_id' => $request['course'],
    		'instructor_id' => $request['instructor'],
    		// 'group_id' => 0
    	]);
    	// Assignment::where()
    	return response()->json(['name'=>Employee::find($request['instructor'])->name]);
    }
    public function instructors(){
    	$institution = Auth::user()->MyInstitution;
    	$c = CourseBreakdown::where(['semester' => OptionsHelper::current_semester(),'institution_id' => $institution->id,'institution_type' => 'Academic\\Department','curriculum_id'=>OptionsHelper::current_curriculum()->id])->get();

        foreach ($c as $cbd) {
            // $cbd->kkk = "kkksss";
            // $cbd->assignment = Assignment::all();
            // $cbd->year
            $cbd->assignment = Assignment::where([
                'academic_year' => OptionsHelper::current_year(),
                'semester' => $cbd->semester,
                // 'batch_year' => $request['year'], 
                'institution_id' => $institution->id, 
                'institution_type' => 'Academic\\Department',
                // 'group_id' => $cbd->year
                // 'group_id' => $cbd->institution_id
                // 'group.institution_type' => $cbd->institution_type,
                // 'group.institution_id' => $cbd->institution_id,
            ])->get();
            // $cbd->assignment->reject(function ($value, $key) {
            //     return $value->group ==  $institution;
            //     // return $value > 2;
            // });

        }
        // $collection = collect([1, 2, 3, 4]);

        // $filtered = $collection->reject(function ($value, $key) {
        //     return $value > 2;
        // });

        // $filtered->all();
    	

        return view('academic::department.instructors',[
        	'breakdowns'=>$c,
        	'instructors' => Employee::all()
        ]);


    }
}
