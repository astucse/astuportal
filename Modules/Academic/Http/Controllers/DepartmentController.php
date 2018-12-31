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
use Modules\Org\Entities\Department;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\Assignment;
use Modules\Academic\Entities\CourseBreakdown;

use Modules\Registration\Entities\InstructorAssignment;

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
    public function instructors_assign(Request $request){
        $institution = Auth::user()->MyInstitution;
        // return $request['instructor_id'];
        InstructorAssignment::create([
            'batch_year' => $request['year'], 
            'institution_id' => $institution->id, 
            'institution_type' => 'Academic\\Department',
            'academic_year' => OptionsHelper::current_year(),
            'semester' => OptionsHelper::current_semester(),
            'course_id' => $request['course_id'],
            'instructor_id' => $request['instructor_id'],
            // 'group_id' => 0
        ]);
        return redirect()->back();
    }

    public function curriculum(){
        $institution = Auth::user()->MyInstitution;
        $curriculum =  OptionsHelper::current_curriculum();
        $breakdown =  $curriculum->breakdown->where('department',$institution)->first();
        
        $r = Role::where(['code'=>'P_INS'])->first();
        return view('academic::department.curriculum',[
            'curriculum'=>$curriculum,
            'breakdown'=>$breakdown,
            'instructors'=>Collect($r->assignment)
                            ->where('rolegiver_type',"Org\Department")
                            ->where('rolegiver_id',$institution->id),
            'current_semester' => OptionsHelper::current_semester(), 
            'assigned' => InstructorAssignment::where([
                // 'batch_year' => $request['year'], 
                'institution_id' => $institution->id, 
                'institution_type' => 'Academic\\Department',
                'academic_year' => OptionsHelper::current_year(),
                'semester' => OptionsHelper::current_semester(),
                // 'course_id' => $request['course_id'],
                // 'instructor_id' => $request['instructor_id'],
            ])->get()
        ]);
        
    }

    public function instructors(){
    	$institution = Auth::user()->MyInstitution;
    	$c = CourseBreakdown::where(['semester' => OptionsHelper::current_semester(),'institution_id' => $institution->id,'institution_type' => 'Academic\\Department','curriculum_id'=>OptionsHelper::current_curriculum()->id])->get();

        foreach ($c as $cbd) {
            $cbd->assignment = Assignment::where([
                'academic_year' => OptionsHelper::current_year(),
                'semester' => $cbd->semester,
                'institution_id' => $institution->id, 
                'institution_type' => 'Academic\\Department',
            ])->get();
        }
        return view('academic::department.instructors',[
        	'breakdowns'=>$c,
        	'instructors' => Employee::all()
        ]);


    }
}
