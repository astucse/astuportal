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
use Auth;
use Illuminate\Routing\Controller;
use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;
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
