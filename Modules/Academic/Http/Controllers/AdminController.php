<?php

namespace Modules\Academic\Http\Controllers;

use App\Models\Option;
use App\Models\Role;
use App\Models\Employee;
use App\Models\Student;
use  Modules\Academic\Entities\Department;
use  Modules\Academic\Entities\School;
use  Modules\Academic\Entities\Course;
use  Modules\Academic\Entities\Enrollment;
use  Modules\Academic\Entities\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index(){
        return view('academic::admin.index');
    }
    public function school(){
        return view('academic::admin.school',['schools'=>School::all()]);
    }
    public function department(){
        $d = Department::all();
        return view('academic::admin.department',['departments'=>$d]);
    }

    public function course(){
        $courses = Course::all();
        return view('academic::admin.course',['courses'=> $courses]);
    }


    public function instructors(){
        return view('academic::admin.instructor',['employees'=>Employee::all(),'options'=>Option::all(),'roles'=>Role::all(),'schools'=>School::all(),'departments'=>Department::all()]);
    }



    public function enroll_submit(Request $request){
        foreach ($request['students'] as $key => $stu_id) {
            Enrollment::create([
                'student_id'=> $stu_id,
                'group_id'=> $request['group_id'],
            ]);
        }
        return redirect()->back();
    }
    public function enroll($group){
        $g = Group::find($group);
        $s = Student::where(['batch_year'=> $g->batch_year])->get();
        return view('academic::admin.enroll',['students'=>$s,'group'=>$g]);
        // return $s->toJson();
    }
    public function enroll_detail($group){
        $g = Group::find($group);
        $s = Student::where(['batch_year'=> $g->batch_year])->get();
        return view('academic::admin.enroll_detail',['students'=>$s,'group'=>$g]);
        // return $s->toJson();
    }
    public function group(){
        $current_year = Option::where(['code'=>'Academic_year'])->first()->value;
        $current_semester = Option::where(['code'=>'Academic_semester'])->first()->value;
        // return Group::where(['year'=>$current_year])->first()->gregorian_year;
        
        $groups = Group::where(['year'=>$current_year,'semester'=>$current_semester])->get();

        // $groups_cse = Group::where(['year'=>$current_year,'semester'=>$current_semester])->get();
        // dd($groups_cse );
        // exit();
        $groupss= $groups->groupBy('batch_year');
        
        $d = Department::all()->groupBy('school_id')->toArray();
        $s = School::all();
        
        // print_r($d);
        // exit();

        return view('academic::admin.group',[
            'departments'=>$d, 'schools'=>$s, 'current_year'=>$current_year, 'groups' => $groups
        ]);
    } 
    public function group_create(Request $request){
        $y = $request['year'];
        $d = $request['department'];
        $s = $request['school'];
        $n = $request['no'];
        $current_year = Option::where(['code'=>'Academic_year'])->first()->value;
        $current_semester = Option::where(['code'=>'Academic_semester'])->first()->value;
        // return ;

        if ($d!=null) {
            $k = Group::where(['batch_year'=> $y,'semester'=> $current_semester,'year'=> $current_year,'freshman'=> false,'school'=> false, 'institution_type' => 'Academic\Department','institution_id' => Department::where(['code'=>$d])->first()->id,
                ])->count();
            for ($i=1+$k; $i <=$n+$k; $i++) { 
                Group::create([
                    'name'=> $i,
                    'batch_year'=> $y,
                    'semester'=> Option::where(['code'=>'Academic_semester'])->first()->value,
                    'year'=> Option::where(['code'=>'Academic_year'])->first()->value,
                    'freshman'=> false,
                    'school'=> false, 
                    'institution_type' => 'Academic\Department',
                    'institution_id' => Department::where(['code'=>$d])->first()->id,
                ]);
            }
        }
        return redirect()->back();
    }
    public function group_submit(Request $request){
        $d = Department::all();
        // return view('academic::admin.group',['departments'=>$d]);
    }
    public function school_submit(Request $request){
        return $request[''];
    }
    // 

}
