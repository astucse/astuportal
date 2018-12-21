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
use  Modules\Academic\Entities\Curriculum;
use  Modules\Academic\Entities\CourseBreakdown;
use  Modules\Academic\Entities\Schedule;
use  Modules\Academic\Entities\Group;
use  Modules\Academic\Entities\Elective;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Helpers\ImportExport as ImportExportHelper;
use App\Helpers\OptionsHelper;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function schedule_api(){
        return "kkk";
    }

    public function schedule_create(Request $request){
        // return now();
        $s = Schedule::create([
            'group_id' => $request['group_id'] ,
            'course_id' => $request['course_id'],
            'day' => $request['day'],
            'start' => ($request['from_hour']+12*$request['fromampm']).':'.$request['from_minute'].':00',
            'end' => ($request['to_hour']+12*$request['fromampm']).':'.$request['to_minute'].':00',
            // 'end' => $request['']
        ]);
        // return $s;
        return redirect()->back();
    }

    public  function schedule($id){
        $g = Group::find($id);
        // return collect($g->schedules);
        // return ;
        return view('academic::admin.schedule',[
            'group' => $g,
            'courses' => Course::all(),
            'monday' => collect($g->schedules)->where('day','monday'),
            'tuesday' => collect($g->schedules)->where('day','tuesday'),
            'wednesday' => collect($g->schedules)->where('day','wednesday'),
            'thursday' => collect($g->schedules)->where('day','thursday'),
            'friday' => collect($g->schedules)->where('day','friday'),
            'saturday' => collect($g->schedules)->where('day','saturday'),
            'sunday' => collect($g->schedules)->where('day','sunday'),
        ]);
    }

    public function breakdown_elective_add(Request $request){
        $e = Elective::create([
            'options' => $request['options'],
            'crhr' => $request['crhr'],
            'courses' => implode(",",$request['courses']),
            'type' => $request['type']
        ]);
        $c = CourseBreakdown::find($request['breakdown_id']);
        $c->electives = $c->electives.",".$e->id;
        $c->save();
        return redirect()->back();
    }

    public function momomo(Request $request){
        $c = Course::find($request['course']);
        if ($request['pre']==0) {
            $c->prequisite_id = null;
        }else{
            $c->prequisite_id = $request['pre'];
        }
        $c->save();
        return response()->json([
            'status' => 'success',
            'data' => $request['course']
        ]);
    }

    public function breakdown_course_add(Request $request){
        $cbd = CourseBreakdown::find($request['breakdown_id']);
        $cbd->courses = $cbd->courses."".implode(",", $request['courses']);
        $cbd->save();
        return redirect()->back();
    }


    public function curriculum(){
        $id = OptionsHelper::current_curriculum()->id;
        return redirect()->route('academic.admin.curriculum_single',['id'=>$id]);
    }
    public function curriculum_single($id){
        $soeec_id   = School::where(['code'=>'SoEEC'])->first()->id;
        $cse_id     = Department::where(['code'=>'CSE'])->first()->id;
        $pce_id     = Department::where(['code'=>'PCE'])->first()->id;
        $ece_id     = Department::where(['code'=>'ECE'])->first()->id;


        $cse_curriculum = CourseBreakdown::where(['curriculum_id'=>$id,'institution_id' => $cse_id,'institution_type' => 'Academic\Department'])->get();
        // print_r($cse_curriculum[7]->electivess[0]->coursess);
        // exit();
        return view('academic::admin.curriculum',[
            'courses' => Course::all(),
            'curriculum' => Curriculum::find($id),
            'curriculums' => Curriculum::all(),
            'coursebreakdown1' => CourseBreakdown::where(['curriculum_id'=>$id,'year'=>1])->get(),
            'coursebreakdown10' => CourseBreakdown::where(['curriculum_id'=>$id,'year'=>2,'semester'=>1,'institution_id' => $soeec_id,'institution_type' => 'Academic\School'])->get(),
            // 'coursebreakdown12' => CourseBreakdown::where(['curriculum_id'=>$id,'year'=>1,'semester'=>2]),
            'coursebreakdown_cse' => $cse_curriculum,
            'coursebreakdown_ece' => CourseBreakdown::where(['curriculum_id'=>$id,'institution_id' => $ece_id,'institution_type' => 'Academic\Department'])->get(),
            'coursebreakdown_pce' => CourseBreakdown::where(['curriculum_id'=>$id,'institution_id' => $pce_id,'institution_type' => 'Academic\Department'])->get(),
            // 'coursebreakdowns' => CourseBreakdown::where(['curriculum_id'=>$id]),
            // 'coursebreakdowns' => CourseBreakdown::where(['curriculum_id'=>$id]),
        ]);
    }
    public function course_export(){
        ImportExportHelper::export2(Course::all(),"Course");
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
