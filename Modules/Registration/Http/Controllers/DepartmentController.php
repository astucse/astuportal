<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Option;
use App\Models\Role;
use App\Models\Employee;
use App\Models\Student;
use Modules\Org\Entities\Department;
use Modules\Org\Entities\School;
use Modules\Academic\Entities\Curriculum;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\Elective;
use Modules\Academic\Entities\CourseBreakdown;
use Modules\Registration\Entities\StudentEnrollment;
use Modules\Registration\Entities\ClassroomGroup;
use Modules\Registration\Entities\EmployeeDepartment;
use Modules\Registration\Entities\InstructorAssignment;
// use Modules\Academic\Entities\Schedule;
use App\Helpers\ImportExport as ImportExportHelper;
use App\Helpers\OptionsHelper;
use Auth;
use \Modules\Registration\Helpers\StudentHelper as RegistrationStudentHelper;
use \Modules\Registration\Helpers\EmployeeHelper as RegistrationEmployeeHelper;
class DepartmentController extends Controller
{
    private $myinstitution="";
    public function __construct(){
        $this->middleware(['auth:employee','departmetHead']);
    }
    public function students(){
        $myinstitution = Auth::user()->MyInstitution;
        $s = RegistrationStudentHelper::registered($myinstitution->id,'department');
        // $r = Role::where(['code'=>'P_STU'])->first();
        return view('registration::department.students',[
            'students'=>$s
        ]);
    }
    public function instructors(){
        $myinstitution = Auth::user()->MyInstitution;
        $r = Role::where(['code'=>'P_INS'])->first();
        return view('registration::department.instructors',[
            'instructors'=>Collect($r->assignment)
                            ->where('rolegiver_type',"Org\Department")
                            ->where('rolegiver_id',$myinstitution->id)
        ]);
    }
    public function group(){
        $this->myinstitution = Auth::user()->MyInstitution;
        $current_year = OptionsHelper::current_year();
        $current_semester = OptionsHelper::current_semester();
        $groups = ClassroomGroup::where([
            'year'=>$current_year,'semester'=>$current_semester, 
            'institution_id' => $this->myinstitution->id,
            'institution_type' => "Org\Department"
        ])->get()->groupBy('batch_year');
        // $group_sci = ClassroomGroup::swhere(['year'=>$current_year,'semester'=>$current_semester, 'prescience' => true])->get();
        $d = Department::all()->groupBy('school_id')->toArray();
        $s = School::all();
        return view('registration::department.group',[
            'departments'=>$d, 'schools'=>$s, 'current_year'=>$current_year, 
            'groups' => $groups,
        ]);
    } 
    public function group_create(Request $request){
        $y = $request['year'];
        $n = $request['no'];
        $current_year = OptionsHelper::current_year();
        $current_semester = OptionsHelper::current_semester();
        // if($d=="preengineering"){
        $k = ClassroomGroup::where([
            'batch_year'=> $y,'semester'=> $current_semester,'year'=> $current_year,
            'institution_type' => 'Org\Department',
            'institution_id' => Auth::user()->MyInstitution->id
            ])->get()->count();
        // return $y;
            // return $key(array);
        for ($i=$k+1; $i <=$n+$k; $i++) { 
            ClassroomGroup::create([
                'name'=> $i,
                'batch_year'=> $y,
                'semester'=> $current_semester,
                'year'=> $current_year,
                // 'freshman'=> false,
                // 'school'=> false, 
                'institution_type' => 'Org\Department',
                'institution_id' => Auth::user()->MyInstitution->id,
            ]);
        }
        // }
        return redirect()->back();
    }

    public function enroll($group){
        $myinstitution = Auth::user()->MyInstitution;
        $r = Role::where(['code'=>'P_STU'])->first();
        $g = ClassroomGroup::find($group);
        // $s = Student::where(['batch_year'=> $g->batch_year])->get();
        return view('registration::department.enroll',
            ['students'=>Collect($r->assignment)
                            ->where('rolegiver_type',"Org\Department")
                            ->where('rolegiver_id',$myinstitution->id)
                            ->pluck('roletaker')
                            ->where('batch_year',$g->batch_year),
            'group'=>$g]
        );
    }

    public function enroll_submit(Request $request){
        foreach ($request['students'] as $key => $stu_id) {
            StudentEnrollment::create([
                'student_id'=> $stu_id,
                'group_id'=> $request['group_id'],
            ]);
        }
        return redirect()->back();
    }


}
