<?php

namespace Modules\StaffEvaluation\Http\Controllers;

use App\Models\Option;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Role;

use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\School;
use Modules\Academic\Entities\Department;
use Modules\Academic\Entities\Group;
use Modules\Academic\Entities\Assignment;
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
class SchoolController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:employee','schoolDean']);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        return view('staffevaluation::department.index');
    }

    // public function evaluation_toggle($id, $action){
    //     $es = EvaluationSession::find($id);
    //     if($action == "stop"){
    //         $es->active = false;
    //     }
    //     if($action == "start"){
    //         $es->active = true;   
    //     }
    //     $es->save();
    //     return redirect()->back();
    // }

    // public function session_single($id){
    //     $es = EvaluationSession::find($id);
    //     $evaluatedHeads = Employee::find(collect($es->answered_heads()->get())->pluck('staff_id'));
    //     $evaluatedStudents = Student::find(collect($es->answered_students()->get())->pluck('student_id'));
    //     $evaluatedCollegues = Employee::find(collect($es->answered_collegues()->get())->pluck('staff_id'));

    //     return view('staffevaluation::admin.session_single',[
    //         'result' => ToEvaluateHelper::result($es),
    //         'evaluated' => [
    //             'students' => $evaluatedStudents,
    //             'collegues' => $evaluatedCollegues,
    //             'heads' => $evaluatedHeads,
    //         ],
    //         'notevaluated' => [
    //             'students' => collect(ToEvaluateHelper::eligibles($es,"student"))->diff($evaluatedStudents),
    //             'heads' => collect(ToEvaluateHelper::eligibles($es,"head"))->diff($evaluatedHeads),
    //             'collegues' => collect(ToEvaluateHelper::eligibles($es,"collegue"))->diff($evaluatedCollegues),
    //         ],
    //         'evaluations' => [
    //             'students' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'student']),
    //             'collegues' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'collegue']),
    //             'heads' => AnsweredQuestion::where(['evaluation_session_id'=>$id,'target'=>'head']),
    //         ],
    //         'evaluationsession' => $es,
    //     ]);
    // }

    // public function sessions_create(Request $request){
    //     $institution = Auth::user()->MyInstitution;
    //     $academic_year = 2011;
    //     $semester = "1";
    //     $assignment = Assignment::find($request['assignment_id']);
        
    //     EvaluationSession::create([
    //         'academic_year' => $assignment->academic_year,
    //         'student_evaluation_id' => $request['student_evaluation_id'],
    //         'head_evaluation_id' => $request['head_evaluation_id'],
    //         'collegue_evaluation_id' => $request['collegue_evaluation_id'],
    //         'target_head_id' => Auth::user()->id,
    //         'target_collegues' => implode(",", $request['target_collegues']),
    //         'staff_id' => $assignment->instructor->id,
    //         'semester' => $assignment->semester,
    //         'target_year' => $assignment->batch_year,
    //         'target_institution_type' => 'Academic\Department',
    //         'target_institution_id' => $institution->id,
    //         'course_id' => $assignment->course->id,
    //         'target_groups' => implode(",", $request['group']),
    //         'assignment_id' => $assignment->id
    //     ]);
        
    //     return redirect()->back();
    // }

    public function evaluation_sessions(){
        $mySchool = Auth::user()->MyInstitution;

        $studentEvaluations = Evaluation::where(['target' => 'student'])->get();
        $collegueEvaluations = Evaluation::where(['target' => 'collegue'])->get();
        $headEvaluations = Evaluation::where(['target' => 'head'])->get();

        $aa = EvaluationSession::where([
            'active' => false,
                'academic_year' => 2011,
                'semester' => 1,
                'target_institution_type' => 'Academic\Department',
                // 'target_institution_id' => $mySchool->id,
            ])->get();
        $a = [];
        foreach ($aa as $temp_a) {
            if($mySchool->departments->contains(Department::find($temp_a->target_institution_id))){
                array_push($a, $temp_a);
            }
        }
        // return sizeof($a);
        // $a = $aa->reject(function ($value, $key) {
        //     return !$mySchool->departments->contains($value->institution);
        // });
        // return sizeof($a);
        return view('staffevaluation::school.evaluation_sessions',[
            'assignments' => $a,
            'staff' => Employee::all(),
            'sessions' => $a,
            'this_year'=> 2011,
            'this_semester' => 1
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
