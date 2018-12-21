<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\StaffEvaluation\Entities\Question;
class AnsweredQuestion extends Model
{
    protected $table = "ses-answered_questions";
    protected $fillable = ['session_token','evaluation_session_id','question_id','rate_answer','write_answer','target'];
    public function question(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\Question','question_id');
    }
    public function evaluation_session(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\EvaluationSession','evaluation_session_id');
    }
    public function getQuestionCategoryAttribute(){
    	return Question::find($this->question_id)->category;
    }
}
