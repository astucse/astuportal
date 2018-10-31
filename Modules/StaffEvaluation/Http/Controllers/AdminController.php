<?php

namespace Modules\StaffEvaluation\Http\Controllers;

use App\Models\Option;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Role;

use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\School;
use Modules\Academic\Entities\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  Modules\StaffEvaluation\Entities\Category;
use  Modules\StaffEvaluation\Entities\Evaluation;
use  Modules\StaffEvaluation\Entities\Question;
use  Modules\StaffEvaluation\Entities\EvaluationSession;
use  Modules\StaffEvaluation\Entities\AnsweredQuestion;

use Illuminate\Routing\Controller;

use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function evaluation_toggle($id, $action){
        $es = EvaluationSession::find($id);
        if($action == "stop"){
            $es->active = false;
        }
        if($action == "start"){
            $es->active = true;   
        }
        $es->save();
        return redirect()->back();
    }

    public function index(){
        return view('staffevaluation::admin.index');
    }
    public function session_single($id){
        $es = EvaluationSession::find($id);
        $evaluatedHeads = Employee::find(collect($es->answered_heads()->get())->pluck('staff_id'));
        $evaluatedStudents = Student::find(collect($es->answered_students()->get())->pluck('student_id'));
        $evaluatedCollegues = Employee::find(collect($es->answered_collegues()->get())->pluck('staff_id'));

        return view('staffevaluation::admin.session_single',[
            'result' => ToEvaluateHelper::result($es),
            'evaluated' => [
                'students' => $evaluatedStudents,
                'collegues' => $evaluatedCollegues,
                'heads' => $evaluatedHeads,
            ],
            'notevaluated' => [
                'students' => collect(ToEvaluateHelper::eligibles($es,"student"))->diff($evaluatedStudents),
                'heads' => collect(ToEvaluateHelper::eligibles($es,"head"))->diff($evaluatedHeads),
                'collegues' => collect(ToEvaluateHelper::eligibles($es,"collegue"))->diff($evaluatedCollegues),
            ],
            'evaluations' => [
                'students' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'student']),
                'collegues' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'collegue']),
                'heads' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'head']),
            ],
            'evaluationsession' => $es,
        ]);
    }
    public function evaluation_single($id){
        $e = Evaluation::find($id);
        return view('staffevaluation::admin.evaluation_single',[
            'evaluation'=>$e,
            'categories' => Category::all(),
        ]);
    }
    public function evaluations(){
        return view('staffevaluation::admin.evaluations',[
            'evaluations' => Evaluation::all()
        ]);
    }
    public function sessions(){
        $studentEvaluations = Evaluation::where(['target' => 'student'])->get();
        $collegueEvaluations = Evaluation::where(['target' => 'collegue'])->get();
        $headEvaluations = Evaluation::where(['target' => 'head'])->get();

        $departmentHeadslist = Employee::whereHas('roles', function ($query) {
            $query->where(['role_id'=> Role::where(['code'=>'A_DHN'])->first()->id]);
        })->get();
        $schoolHeadslist = Employee::whereHas('roles', function ($query) {
            $query->where(['role_id'=> Role::where(['code'=>'A_SDN'])->first()->id]);
        })->get();

        return view('staffevaluation::admin.sessions',[
            'evaluationSessions' => EvaluationSession::all(),
            'staff' => Employee::all(),
            'courses' => Course::all(),
            'departments' => Department::all(),
            'schools' => School::all(),
            'studentEvaluations' => $studentEvaluations,
            'collegueEvaluations' => $collegueEvaluations,
            'headEvaluations' => $headEvaluations,
            'schoolHeads' => $schoolHeadslist,
            'departmentHeads' => $departmentHeadslist
        ]);
    }

    public function sessions_create(Request $request){
        $academic_year = 2011;
        $semester = "1";
        if($request['school_id'] == "0"){
            // return $academic_year;
            EvaluationSession::create([
                'academic_year' => $academic_year,
                'student_evaluation_id' => $request['student_evaluation_id'],
                'head_evaluation_id' => $request['head_evaluation_id'],
                'collegue_evaluation_id' => $request['collegue_evaluation_id'],
                'target_head_id' => $request['target_head_id'],
                'target_collegues' => implode(",", $request['target_collegues']),
                'staff_id' => $request['instructor_id'],
                'semester' => $semester,
                'target_year' => '1',
                // 'target_institution_type' => 'division',
                // 'target_institution_id' => 1,
                'course_id' => $request['course_id'],
                'target_groups' => implode(",", $request['group']),
            ]);
        }else if($semester == 1 && $request['department_id'] == 0){
            EvaluationSession::create([
                'academic_year' => $academic_year,
                'student_evaluation_id' => $request['student_evaluation_id'],
                'head_evaluation_id' => $request['head_evaluation_id'],
                'collegue_evaluation_id' => $request['collegue_evaluation_id'],
                'target_head_id' => $request['target_head_id'],
                'target_collegues' => implode(",", $request['target_collegues']),
                'staff_id' => $request['instructor_id'],
                'semester' => $semester,
                'target_year' => $request['target_year'],
                'target_institution_type' => 'Academic\School',
                'target_institution_id' => $request['school_id'],
                'course_id' => $request['course_id'],
                'target_groups' => implode(",", $request['group']),
            ]);
        }else{
            EvaluationSession::create([
                'academic_year' => $academic_year,
                'student_evaluation_id' => $request['student_evaluation_id'],
                'head_evaluation_id' => $request['head_evaluation_id'],
                'collegue_evaluation_id' => $request['collegue_evaluation_id'],
                'target_head_id' => $request['target_head_id'],
                'target_collegues' => implode(",", $request['target_collegues']),
                'staff_id' => $request['instructor_id'],
                'semester' => $semester,
                'target_year' => $request['target_year'],
                'target_institution_type' => 'Academic\Department',
                'target_institution_id' => $request['department_id'],
                'course_id' => $request['course_id'],
                'target_groups' => implode(",", $request['group']),
            ]);
        }
        
        return redirect()->back();
    }

    public function setting(){
        // EvaluationSession::
        return view('staffevaluation::admin.setting',[
            'weight_student' => Option::where('code','SES_STUDENT_PERCENT')->first()->value,
            'weight_collegue' => Option::where('code','SES_COLLEGUE_PERCENT')->first()->value,
            'weight_head' => Option::where('code','SES_HEAD_PERCENT')->first()->value,
        ]);
    }
    public function equation_update(Request $request){
        if($request['weight_s']+$request['weight_h']+$request['weight_c'] == 100){
            $s_p = Option::where(['code'=> 'SES_STUDENT_PERCENT'])->get()[0];
            $s_p->value = $request['weight_s'];
            $s_p->save();
            $h_p = Option::where(['code'=> 'SES_COLLEGUE_PERCENT'])->get()[0];
            $h_p->value = $request['weight_c'];
            $h_p->save();
            $c_p = Option::where(['code'=> 'SES_HEAD_PERCENT'])->get()[0];
            $c_p->value = $request['weight_h'];
            $c_p->save();
        }
        return redirect()->back();
    }

    
}
