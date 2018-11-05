<?php
namespace Modules\StaffEvaluation\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Role;

use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\School;
use Modules\Academic\Entities\Department;
use Modules\Academic\Entities\Enrollment;

use Modules\StaffEvaluation\Entities\AnsweredQuestion;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  Modules\StaffEvaluation\Entities\Category;
use  Modules\StaffEvaluation\Entities\Evaluation;
use  Modules\StaffEvaluation\Entities\Question;
use  Modules\StaffEvaluation\Entities\EvaluationSession;
use  Modules\StaffEvaluation\Entities\StudentEvaluation;
use  Modules\StaffEvaluation\Entities\CollegueEvaluation;
use  Modules\StaffEvaluation\Entities\HeadEvaluation;

use Illuminate\Support\Facades\Hash;



class ToEvaluateHelper {


    public static function mySessions($uid){
        return [
            'past'=>EvaluationSession::where(['staff_id'=>$uid,'active'=>false])->get(),
            'current'=>EvaluationSession::where(['staff_id'=>$uid,'active'=>true])->get(),
        ];
    }

    public static function result($es){

        $collection = AnsweredQuestion::where(['evaluation_session_id' => $es->id])->get();
        $collectionStudent = AnsweredQuestion::where([ 'target' => 'student', 'evaluation_session_id' => $es->id])->get();
        $collectionInstructor = AnsweredQuestion::where([ 'target' => 'collegue','evaluation_session_id' => $es->id])->get();
        $collectionHead = AnsweredQuestion::where([ 'target' => 'head','evaluation_session_id' => $es->id])->get();
        $answerStudent = $collectionStudent->groupBy('session_token');
        $answerInstructor = $collectionInstructor->groupBy('session_token');
        $answerHead = $collectionHead->groupBy('session_token');
        $n = 0;
        $t = 0;
        foreach ($answerStudent as $value) {
            $num = 0; $tot = 0;
            foreach($value as $v){
                if($v->question->type == "rate"){
                    $num+=1;
                    $tot+=$v->rate_answer;
                }
            }
            $n++; $t+= $tot/$num;
        }
        if($n==0)
            $es_averageStudent = 0;
        else
            $es_averageStudent = $t/$n;
        $n = 0;
        $t = 0;
        foreach ($answerInstructor as $value) {
            $num = 0; $tot = 0;
            foreach($value as $v){
                if($v->question->type == "rate"){
                    $num+=1;
                    $tot+=$v->rate_answer;
                }
            }
            $n++; 
            $t+= $tot/$num;
        }
        if($n==0)
            $es_averageCollegue = 0;
        else
            $es_averageCollegue = $t/$n;
        $n = 0;
        $t = 0;
        foreach ($answerHead as $value) {
            $num = 0; $tot = 0;
            foreach($value as $v){
                if($v->question->type == "rate"){
                    $num+=1;
                    $tot+=$v->rate_answer;
                }
            }
            $n++; $t+= $tot/$num;
        }
        if($n==0)
            $es_averageHead = 0;
        else
            $es_averageHead = $t/$n;

        $s_p = Option::where(['code'=> 'SES_STUDENT_PERCENT'])->first()->value;
        $h_p = Option::where(['code'=> 'SES_COLLEGUE_PERCENT'])->first()->value;
        $c_p = Option::where(['code'=> 'SES_HEAD_PERCENT'])->first()->value;
        $all = ($es_averageStudent*$s_p + $es_averageCollegue*$c_p + $es_averageHead*$h_p)/100;
        return [
            'all' => $all,
            'student'  => $es_averageStudent,          
            'collegue'  => $es_averageCollegue,          
            'head'  => $es_averageHead,          
        ];
    }
    public static function eligibles($es,$type){
        $ay= 2011;
        $semester= 1;
        $ans = [];
        switch ($type) {
            case 'student':
                foreach ($es->groups as $group) {
                    foreach ($group->enrollments as $enrollment) {
                        array_push($ans, $enrollment->student);
                    }
                }
                break;
            
            case 'collegue':
                $ans = $es->collegues;
                break;
            case 'head':
                $ans = [$es->target_head];
                break;

        }
        return $ans;
    }
    public static function canEvaluate($id,$type){
        $uid = Auth::user()->id;
        
        if($type == "collegue" ){
            if (!collect(EvaluationSession::find($id)->collegues)->pluck('id')->contains($uid)) {
                return false;
            }
            if (CollegueEvaluation::where(['evaluation_session_id'=> $id,'staff_id'=>$uid])->count() != 0 ){
                return false;
            }
        }elseif ($type =="student") {
            if (StudentEvaluation::where(['student_id'=> $uid])->pluck('evaluation_session_id')->contains($id)) {
                        return false;
                    }
        }elseif ($type == "head") {
            if (EvaluationSession::find($id)->target_head_id!=$uid) {
                return false;
            }
            if(HeadEvaluation::where(['staff_id'=> $uid])->pluck('evaluation_session_id')->contains($id)) {
                    return false;
            }
        }
        return true;
    }

    public static function sessionsToBeFilled($type) {
        $ay= 2011;
        $semester= 1;
        $uid = Auth::user()->id;

        if($type == 'student'){
            $enroll = Student::where(['id'=>$uid])->first()
                                ->enrollments->where('group.semester', $semester)
                                            ->where('group.year', $ay)->first();
            if($enroll===null){
                return [];  
            }
            $evalsess = EvaluationSession::where([
                'active'=> true, 
                'target_institution_type'=>$enroll->group->institution_type,
                'target_year'=> $enroll->group->batch_year,
                'target_institution_id'=> $enroll->group->institution_id
            ])->get();    
            $s = array();
            foreach ($evalsess as $ee) {
                $gs = $ee->target_groups;
                $gsa = explode(",", $gs);
                if( in_array($enroll->group->name, $gsa) ){
                    if (!StudentEvaluation::where(['student_id'=> $uid])->pluck('evaluation_session_id')->contains($ee->id)) {
                        array_push($s, $ee);
                    }
                }
            }
        }elseif($type == 'collegue'){
            $evalsess = EvaluationSession::where(['active'=> true])->get();
            $s = array();
            foreach ($evalsess as $ee) {
                $gs = $ee->collegues;
                if(collect($gs)->contains('id', $uid) && !CollegueEvaluation::where(['staff_id'=> $uid])->pluck('evaluation_session_id')->contains($ee->id)) {
                    array_push($s, $ee);
                }
            }
            
        }elseif($type == 'head'){
            $evalsess = EvaluationSession::where(['active'=> true, 'target_head_id' => Auth::user()->id ])->get();
            $s = array();
            foreach ($evalsess as $ee) {
                if(!HeadEvaluation::where(['staff_id'=> $uid])->pluck('evaluation_session_id')->contains($ee->id)) {
                    array_push($s, $ee);
                }
            }
        }
        return $s;
    }

    public static function answerevaluation($request, $type){
        $evalsession_id  = $request['evaluationsession_id'];
        $eval_id  = $request['evaluation_id'];
        $eval = Evaluation::where(['id'=> $eval_id])->get()[0];
        $salt = Hash::make($eval_id." ".$evalsession_id);
        
        $a = Auth::user();
        if($type == 'student'){
            StudentEvaluation::create(['student_id' => $a->id,'evaluation_session_id' => $evalsession_id]);
            // $a->filled_evaluation_sessions()->attach($evalsession_id);
        }elseif($type == 'collegue'){
            CollegueEvaluation::create(['staff_id' => $a->id,'evaluation_session_id' => $evalsession_id]);
        }elseif($type == 'head'){
            HeadEvaluation::create(['staff_id' => $a->id,'evaluation_session_id' => $evalsession_id]);
        }        
        foreach($eval->questions as $q){
            if($q->type == "rate"){
                $e = AnsweredQuestion::create([
                    'target' => $type,
                    'question_id' => $q->id,
                    'evaluation_session_id' => $evalsession_id, 
                    'session_token' => $salt, 
                    'rate_answer' => $request['question'.$q->id]
                ]);
            }else{
                AnsweredQuestion::create([
                    'target' => $type,
                    'question_id' => $q->id,
                    'evaluation_session_id' => $evalsession_id, 
                    'session_token' => $salt, 
                    'write_answer' => $request['question'.$q->id]
                ]);
            }
        }
    }

}