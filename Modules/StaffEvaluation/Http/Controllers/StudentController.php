<?php

namespace Modules\StaffEvaluation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;

use Modules\StaffEvaluation\Entities\Evaluation;
use Modules\StaffEvaluation\Entities\EvaluationSession;
use Modules\StaffEvaluation\Entities\StudentEvaluation;

class StudentController extends Controller{

    public function __construct(){
        $this->middleware('auth:student');
    }
    public function index(){
        return view('staffevaluation::index');
    }

    public function evaluations(){
        // $uid = Auth::user()->id;
        $s =  ToEvaluateHelper::sessionsToBeFilled('student');
        // return $s;
        // $es  = EvaluationSession::where(['id'=>$id])->get()[0];
        // if(collect($es->answered_students()->get())->contains('id', $uid)){
        //    return abort(404); 
        // }
        return view('staffevaluation::student.evaluation',[
            'evaluations' => $s
        ]);
    }
    public function evaluate(Request $request){
        ToEvaluateHelper::answerevaluation($request, 'student');
        // return $request['question1']."kk";
        return redirect()->route('staffevaluation.student.evaluations');
    }
    public function evaluations_single($id){
        $es = EvaluationSession::find($id);
        // $uid = Auth::user()->id;
        // $s =  ToEvaluateHelper::sessionsToBeFilled('student');
        // return $s;
        // $es  = EvaluationSession::where(['id'=>$id])->get()[0];
        if(!ToEvaluateHelper::canEvaluate($id,"student")){
           return abort(404); 
        }
        return view('staffevaluation::student.evaluation_single',[
            'evaluationsession' => $es
        ]);
    }




   
}
