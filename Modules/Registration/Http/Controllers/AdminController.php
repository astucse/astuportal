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
class AdminController extends Controller
{
    public function group(){
        $current_year = OptionsHelper::current_year();
        $current_semester = OptionsHelper::current_semester();
        $group_eng = ClassroomGroup::where(['year'=>$current_year,'semester'=>$current_semester, 'preengineering' => true])->get();
        $group_sci = ClassroomGroup::where(['year'=>$current_year,'semester'=>$current_semester, 'prescience' => true])->get();
        // $groupss= $groups->groupBy('batch_year');
        // return $groupss;
        $d = Department::all()->groupBy('school_id')->toArray();
        $s = School::all();
        return view('registration::admin.group',[
            'departments'=>$d, 'schools'=>$s, 'current_year'=>$current_year, 
            'group_preengineering' => $group_eng,
            'group_prescience' => $group_sci,
        ]);
    } 
    public function group_create(Request $request){
        $y = $request['year'];
        $d = $request['department'];
        $s = $request['school'];
        $n = $request['no'];
        $current_year = OptionsHelper::current_year();
        $current_semester = OptionsHelper::current_semester();
        if($d=="preengineering"){
            $k = ClassroomGroup::where([
                'semester'=> $current_semester,'year'=> $current_year,
                'preengineering' => true,
            ])->count();
            for ($i=$k+1; $i <=$n+$k; $i++) { 
                ClassroomGroup::create([
                    'name'=> $i,
                    'batch_year'=> $y,
                    'semester'=> $current_semester,'year'=> $current_year,
                    'preengineering' => true,
                ]);
            }
        }elseif($d=="prescience"){
            $k = ClassroomGroup::where([
                'semester'=> $current_semester,'year'=> $current_year,
                'prescience' => true,
            ])->count();
            for ($i=$k+1; $i <=$n+$k; $i++) { 
                ClassroomGroup::create([
                    'name'=> $i,
                    'batch_year'=> $y,
                    'semester'=> $current_semester,'year'=> $current_year,
                    'prescience' => true,
                ]);
            }
        }elseif ($d!=null) {
            $k = ClassroomGroup::where([
                'batch_year'=> $y,'semester'=> $current_semester,'year'=> $current_year,
                'institution_type' => 'Academic\Department',
                'institution_id' => Department::where(['code'=>$d])->first()->id
                ])->count();
                // return $k;
            for ($i=$k+1; $i <=$n+$k; $i++) { 
                ClassroomGroup::create([
                    'name'=> $i,
                    'batch_year'=> $y,
                    'semester'=> Option::where(['code'=>'Academic_semester'])->first()->value,
                    'year'=> Option::where(['code'=>'Academic_year'])->first()->value,
                    // 'freshman'=> false,
                    // 'school'=> false, 
                    'institution_type' => 'Academic\Department',
                    'institution_id' => Department::where(['code'=>$d])->first()->id,
                ]);
            }
        }
        return redirect()->back();
    }
    // public function group_submit(Request $request){
        // $d = Department::all();
        // return view('registration::admin.group',['departments'=>$d]);
    // }
    public function enroll_submit(Request $request){
        foreach ($request['students'] as $key => $stu_id) {
            StudentEnrollment::create([
                'student_id'=> $stu_id,
                'group_id'=> $request['group_id'],
            ]);
        }
        return redirect()->back();
    }
    public function enroll($group){
        $g = ClassroomGroup::find($group);
        $s = Student::where(['batch_year'=> $g->batch_year])->get();
        return view('registration::admin.enroll',['students'=>$s,'group'=>$g]);
    }
    public function enroll_detail($group){
        $g = ClassroomGroup::find($group);
        $s = Student::where(['batch_year'=> $g->batch_year])->get();
        return view('registration::admin.enroll_detail',['students'=>$s,'group'=>$g]);
    }
}
