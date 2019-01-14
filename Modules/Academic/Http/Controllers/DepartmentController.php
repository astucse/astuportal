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
        $this->middleware(['auth:employee','departmetHead']);//->except('curriculum');
    }
    public function instructors_assign_api(Request $request){
        // return ;
        $institution = Auth::user()->MyInstitution;
        Assignment::create([
            'batch_year' => $request['year'], 
            'institution_id' => $institution->id, 
            'institution_type' => 'Org\\Department',
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
            'institution_type' => 'Org\\Department',
            'academic_year' => OptionsHelper::current_year(),
            'semester' => OptionsHelper::current_semester(),
            'course_id' => $request['course_id'],
            'instructor_id' => $request['instructor_id'],
            // 'group_id' => 0
        ]);
        return redirect()->back();
    }

    public function courseload(){
        $institution = Auth::user()->MyInstitution;
        $curriculum =  OptionsHelper::current_curriculum();
        $breakdown =  $curriculum->breakdown->where('department',$institution)->first();
        $r = Role::where(['code'=>'P_INS'])->first();
        return view('academic::department.courseload',[
            'curriculum'=>$curriculum,
            'breakdown'=>$breakdown,
            'instructors'=>Collect($r->assignment)
                            ->where('rolegiver_type',"Org\Department")
                            ->where('rolegiver_id',$institution->id),
            'current_semester' => OptionsHelper::current_semester(), 
            'assigned' => InstructorAssignment::where([
                'institution_id' => $institution->id, 
                'institution_type' => 'Org\\Department',
                'academic_year' => OptionsHelper::current_year(),
                'semester' => OptionsHelper::current_semester(),
            ])->get()
        ]);
    }
    public function curriculum(){
        $institution = Auth::user()->MyInstitution;
        $curriculum =  OptionsHelper::current_curriculum();
        $breakdown =  $curriculum->breakdown->where('department',$institution)->first();
        $r = Role::where(['code'=>'P_INS'])->first();
        return view('academic::department.curriculum',[
            'curriculum'=>$curriculum,
            'breakdown'=>$breakdown,
            'courses'=>Course::all(),
            'current_semester' => OptionsHelper::current_semester(), 
            'assigned' => InstructorAssignment::where([
                'institution_id' => $institution->id, 
                'institution_type' => 'Org\\Department',
                'academic_year' => OptionsHelper::current_year(),
                'semester' => OptionsHelper::current_semester(),
            ])->get()   
        ]);
    }


    public function coursetocurr(Request $request){
       $s =  $request['semester_id'];
       $ss = explode("-",$s);
       // $ss[0]
       $d = $request['dep_id'];
       $dep = Department::find($d);
       $c = $request['course_id'];
       $cou = Course::find($c);
       $popo = [[],[0,1],[0,2],[3,4,5],[6,7,8],[9,10]];

       // return "Year ".$dep->code;

       $a = \Modules\Academic\Entities\Curriculum::find(1);
        $ans = Collect($a->courses);
        foreach ($ans as $sche) {
            // return $ss[0];
            // return $sche['schedule'][]];
            // return $popo[$ss[0]][$ss[1]];
            if ($sche['department']==$dep->code) {
                // return $popo[2][2 - 1];
            // return $sche['schedule'][$popo[3][1 - 1]];
            // return $sche['schedule'][$popo[$ss[0]][$ss[1]] - 1];
                
                    $schesss =  Collect($sche['schedule'][$popo[$ss[0]][$ss[1] -1]]['courses']);
                    $schesss->push($cou->code);
                    return $schesss;
                    // $sche['schedule'][$popo[$ss[0]][$ss[1] -1]]['courses'] = $schesss;
                // foreach ($sche['schedule'] as $semester) {
                //     if ($semester['semester']==$ss[1] && $semester['year']==$ss[0]) {
                //         $qwer = Collect($semester['courses']); 
                //         $qwer->push($cou->code);
                //         $semester['courses'] = $qwer; 
                //         // return $ss[0];
                //         // return $semester['courses'];
                //     }
                // }
            }
        }
        return $ans;
            // $realarr = [
            //    "department" => $dep->code,
            //    "schedule" => [
            //      [
            //        "year" => 1,
            //        "semester" => 1,
            //        "courses" => [
    }

    public function instructors(){
    	$institution = Auth::user()->MyInstitution;
    	$c = CourseBreakdown::where(['semester' => OptionsHelper::current_semester(),'institution_id' => $institution->id,'institution_type' => 'Org\\Department','curriculum_id'=>OptionsHelper::current_curriculum()->id])->get();

        foreach ($c as $cbd) {
            $cbd->assignment = Assignment::where([
                'academic_year' => OptionsHelper::current_year(),
                'semester' => $cbd->semester,
                'institution_id' => $institution->id, 
                'institution_type' => 'Org\\Department',
            ])->get();
        }
        return view('academic::department.instructors',[
        	'breakdowns'=>$c,
        	'instructors' => Employee::all()
        ]);


    }
}
