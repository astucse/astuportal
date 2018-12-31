<?php

namespace Modules\StaffEvaluation\Http\Controllers;

use App\Models\Option;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Role;

use Modules\Academic\Entities\Course;
use Modules\Org\Entities\School;
use Modules\Org\Entities\Department;
use Modules\Registration\Entities\ClassroomGroup as Group;
// use Modules\Academic\Entities\Assignment;
use Modules\Registration\Entities\InstructorAssignment as Assignment;
use Modules\Academic\Entities\CourseBreakdown;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  Modules\StaffEvaluation\Entities\Category;
use  Modules\StaffEvaluation\Entities\Evaluation;
use  Modules\StaffEvaluation\Entities\Question;
use  Modules\StaffEvaluation\Entities\EvaluationSession;
use  Modules\StaffEvaluation\Entities\AnsweredQuestion;
use Auth;
use Illuminate\Routing\Controller;
use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;
use App\Helpers\OptionsHelper;
use App\Helpers\OfficeHelper;
use PDF;
use Illuminate\Support\Str;
class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:employee','departmetHead']);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        return view('staffevaluation::department.index');
    }

    public function setting(){
        $reports = OptionsHelper::ses_reports(Auth::user()->MyInstitution->id);
        return view('staffevaluation::department.setting',['reports'=>$reports]);
    }
    public function update_report(Request $request){
        $id = Auth::user()->MyInstitution->id;        $g = Option::where(['code' => 'SES_GOOD_REPORT_LETTER','parameter_1'=>$id])->first();
        $m = Option::where(['code' => 'SES_MEDIUM_REPORT_LETTER','parameter_1'=>$id])->first();
        $b = Option::where(['code' => 'SES_BAD_REPORT_LETTER','parameter_1'=>$id])->first();
        $g->value = $request['good'];
        $b->value = $request['bad'];
        $m->value = $request['medium'];
        $g->save();
        $b->save();
        $m->save();
        return redirect()->back();
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

    public function session_report($id){
        $s = OptionsHelper::current_semester();
        $y = OptionsHelper::current_year();
        $staff = Employee::find($id);
        $performance = $staff->net_performance[$y][$s];
        $idI = Auth::user()->MyInstitution->id;
        // $a = EvaluationSession::find($id);
        $performance_name = OptionsHelper::ses_point_label($performance['all']);
        if ($performance_name =="good") {
            $v = Option::where(['code' => 'SES_GOOD_REPORT_LETTER','parameter_1'=>$idI])->first()->value;
        }elseif ($performance_name =="medium") {
            $v = Option::where(['code' => 'SES_MEDIUM_REPORT_LETTER','parameter_1'=>$idI])->first()->value;
        }else{
            $v = Option::where(['code' => 'SES_BAD_REPORT_LETTER','parameter_1'=>$idI])->first()->value;
        }
        // print_r($performance);
        // return "";
        // return $performance_name;
        $v = str_replace("&lt;&lt;Instructor&gt;&gt;",$staff->name,$v);
        $v = str_replace("&lt;&lt;Student&gt;&gt;",$performance['student'],$v);
        $v = str_replace("&lt;&lt;Collegue&gt;&gt;",$performance['collegue'],$v);
        $v = str_replace("&lt;&lt;Head&gt;&gt;",$performance['head'],$v);
        $v = str_replace("&lt;&lt;Result&gt;&gt;",$performance['all'],$v);
        $pdf = PDF::loadView('staffevaluation::department.report', ['content'=>$v]);
        return $pdf->download('report.pdf');

    }

    public function session_single($id){
        $es = EvaluationSession::find($id);
        $evaluatedHeads = Employee::find(collect($es->answered_heads()->get())->pluck('staff_id'));
        $evaluatedStudents = Student::find(collect($es->answered_students()->get())->pluck('student_id'));
        $evaluatedCollegues = Employee::find(collect($es->answered_collegues()->get())->pluck('staff_id'));

        return view('staffevaluation::department.session_single',[
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

    public function sessions_create(Request $request){
        $institution = Auth::user()->MyInstitution;
        $academic_year = 2011;
        $semester = "1";
        $assignment = Assignment::find($request['assignment_id']);
        // use Illuminate\Support\Str;
        EvaluationSession::create([
            'uuid' => Str::uuid(),
            'academic_year' => $assignment->academic_year,
            'student_evaluation_id' => $request['student_evaluation_id'],
            'head_evaluation_id' => $request['head_evaluation_id'],
            'collegue_evaluation_id' => $request['collegue_evaluation_id'],
            'target_head_id' => Auth::user()->id,
            'target_collegues' => implode(",", $request['target_collegues']),
            'staff_id' => $assignment->instructor->id,
            'semester' => $assignment->semester,
            'target_year' => $assignment->batch_year,
            'target_institution_type' => 'Org\Department',
            'target_institution_id' => $institution->id,
            'course_id' => $assignment->course->id,
            'target_groups' => implode(",", $request['group']),
            'assignment_id' => $assignment->id
        ]);
        
        return redirect()->back();
    }

    public function evaluation_sessions(){
        $institution = Auth::user()->MyInstitution;

        $studentEvaluations = Evaluation::where(['target' => 'student'])->get();
        $collegueEvaluations = Evaluation::where(['target' => 'collegue'])->get();
        $headEvaluations = Evaluation::where(['target' => 'head'])->get();

        $a = Assignment::where([
            // 'batch_year', 
            'institution_id' => $institution->id, 
            'institution_type' => 'Org\\Department'
        ])->get();
        // return sizeof($a);
        $sessionss =  EvaluationSession::where([
            'academic_year' => 2011,
            'semester' => 1,
            'target_institution_type' => 'Org\Department',
            'target_institution_id' => $institution->id,
        ])->get()->groupBy('staff_id');
        // dd($sessions);
        // foreach ($sessionss as $key => $sessions) {
        //     echo " ".$sessions[0]->staff;
        //     echo "<br>";
        // }
        // return "";
        return view('staffevaluation::department.evaluation_sessions',[
            'assignments' => $a,
            'staff' => Employee::all(),
            'studentEvaluations' => $studentEvaluations,
            'collegueEvaluations' => $collegueEvaluations,
            'headEvaluations' => $headEvaluations,
            'sessionss' => $sessionss,
        ]);
    }

    public function evaluate(Request $request){
        ToEvaluateHelper::answerevaluation($request, 'head');
        return redirect()->route('staffevaluation.department.evaluations');
    }

    public function evaluations(){
        return view('staffevaluation::department.evaluations',[
            'evaluations' => ToEvaluateHelper::sessionsToBeFilled('head'),
        ]);
    }
    public function evaluation_single($id){
        $es = EvaluationSession::find($id);
        if(!ToEvaluateHelper::canEvaluate($id,"head")){
           return abort(404); 
        }
        return view('staffevaluation::department.evaluation_single',[
            'evaluationsession' => $es
        ]);
    }

}
