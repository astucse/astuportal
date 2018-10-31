<?php

namespace Modules\StaffEvaluation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Auth;
use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;

use Modules\StaffEvaluation\Entities\Evaluation;
use Modules\StaffEvaluation\Entities\EvaluationSession;
use Modules\StaffEvaluation\Entities\Category;
use Modules\StaffEvaluation\Entities\StudentEvaluation;

class EmployeeController extends Controller{

    public function __construct(){
        $this->middleware('auth:employee');
    }

    public function myevaluation_single($id){
        $es = EvaluationSession::find($id);
        return view('staffevaluation::employee.myevaluation_single',[
            'evaluation'=>$es,
            'categories' => Category::all()
        ]);
    }
    public function evaluations(){
        $s =  ToEvaluateHelper::sessionsToBeFilled('collegue');
        return view('staffevaluation::employee.evaluation',[
            'evaluations' => $s
        ]);
    }
    public function evaluate(Request $request){
        ToEvaluateHelper::answerevaluation($request, 'collegue');
        return redirect()->route('staffevaluation.collegue.evaluations');
    }
    public function evaluations_single($id){
        $es = EvaluationSession::find($id);
        if(!ToEvaluateHelper::canEvaluate($id,"collegue")){
           return abort(404); 
        }
        return view('staffevaluation::employee.evaluation_single',[
            'evaluationsession' => $es
        ]);
        // return $id;
    }


    public function myevaluations(){
        $uid = Auth::user()->id;
        $s =  ToEvaluateHelper::mySessions($uid);
        return view('staffevaluation::employee.myevaluation',[
            'evaluations' => $s
        ]);
    }




   
}
