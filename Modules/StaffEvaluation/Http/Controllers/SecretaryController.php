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

use Illuminate\Routing\Controller;
use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;
use App\Helpers\OptionsHelper;
use App\Helpers\OfficeHelper;
use PDF;
use Auth;
use Illuminate\Support\Str;
class SecretaryController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:employee','secretary']);
    }

    public function evaluationresults(){
        $institution = Auth::user()->MyInstitution;

        $studentEvaluations = Evaluation::where(['target' => 'student'])->get();
        $collegueEvaluations = Evaluation::where(['target' => 'collegue'])->get();
        $headEvaluations = Evaluation::where(['target' => 'head'])->get();

        $a = Assignment::where([
            // 'batch_year', 
            'institution_id' => $institution->id, 
            'institution_type' => 'Org\\Department'
        ])->get();
        $sessionss =  EvaluationSession::where([
            'academic_year' => 2011,
            'semester' => 1,
            'target_institution_type' => 'Org\Department',
            'target_institution_id' => $institution->id,
        ])->get()->groupBy('staff_id');
        // return  $institution;
        
        return view('staffevaluation::department.secretary_evaluationresults',[
            'assignments' => $a,
            'staff' => Employee::all(),
            'studentEvaluations' => $studentEvaluations,
            'collegueEvaluations' => $collegueEvaluations,
            'headEvaluations' => $headEvaluations,
            'sessionss' => $sessionss,
        ]);
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
    
}
