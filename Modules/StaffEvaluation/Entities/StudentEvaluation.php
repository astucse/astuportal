<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentEvaluation extends Model
{
    protected $fillable = ['id','student_id','evaluation_session_id'];
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
    public function evaluation_session(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\EvaluationSession');
    }
}
