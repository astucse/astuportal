<?php

namespace Modules\Registration\Helpers;
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
class EmployeeHelper {

	public static function registered($depar_id){
		$myinstitution = Department::find($depar_id);
        $r = Role::where(['code'=>'P_INS'])->first();
        return Collect($r->assignment)
                    ->where('rolegiver_type',"Org\Department")
                    ->where('rolegiver_id',$myinstitution->id)->pluck('roletaker');
	}


}