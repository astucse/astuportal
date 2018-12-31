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

class SchoolController extends Controller
{
    private $myinstitution="";
    public function __construct(){
        $this->middleware(['auth:employee','schoolDean']);
    }
    public function group(){
        $this->myinstitution = Auth::user()->MyInstitution;
        $current_year = OptionsHelper::current_year();
        $current_semester = OptionsHelper::current_semester();
        $groups = ClassroomGroup::where([
            'year'=>$current_year,'semester'=>$current_semester, 
            'institution_id' => $this->myinstitution->id,
            'institution_type' => "Org\School"
        ])->get()->groupBy('batch_year');
        // $group_sci = ClassroomGroup::where(['year'=>$current_year,'semester'=>$current_semester, 'prescience' => true])->get();
        $d = Department::all()->groupBy('school_id')->toArray();
        $s = School::all();
        // return "d";
        return view('registration::school.group',[
            'departments'=>$d, 'schools'=>$s, 'current_year'=>$current_year, 
            'groups' => $groups,
        ]);
    } 
}
