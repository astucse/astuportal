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
class StudentHelper {

	public static function registered($depar_id,$type){
		$ans = Collect([]);
		if ($type=="department") {
			$i = Department::find($depar_id);
			foreach ($i->groups as $g) {
				foreach ($g->enrollments as $value) {
					$ans->push($value->student);
				}
			}
			// return "ss";
			// // return $i->groups;
			// StudentEnrollment::where([])->unique();
			// return "ss";
		}else{

		}
		return $ans->unique();
	}





}