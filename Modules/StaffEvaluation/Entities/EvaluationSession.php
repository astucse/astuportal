<?php

namespace Modules\StaffEvaluation\Entities;

use App\Models\Employee;
use App\Models\Student;
use Modules\Academic\Entities\Enrollment;
use Modules\Academic\Entities\Group;
use Modules\StaffEvaluation\Entities\AnsweredQuestion;
use Illuminate\Database\Eloquent\Model;
use Modules\StaffEvaluation\Helpers\ToEvaluateHelper;
class EvaluationSession extends Model
{
    protected $fillable = ['id','student_evaluation_id','collegue_evaluation_id','head_evaluation_id','staff_id','active','academic_year','semester','course_id','target_institution_id','target_institution_type','target_groups','target_year','target_collegues','target_head_id'];

    // public function scopeType($query, $type)
    // {
    //     return $query->where('type', $type);
    // }
    public function student_evaluation(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\Evaluation','student_evaluation_id');
    }
    public function head_evaluation(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\Evaluation','head_evaluation_id');
    }
    public function course(){
        return $this->belongsTo('Modules\Academic\Entities\Course');
    }
    public function collegue_evaluation(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\Evaluation','collegue_evaluation_id');
    }

    public function answered_students(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\StudentEvaluation','evaluation_session_id','id');
    }
    public function answered_collegues(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\CollegueEvaluation','evaluation_session_id','id');
    }
    public function answers(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\AnsweredQuestion','evaluation_session_id','id');
    }
    public function answered_heads(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\HeadEvaluation','evaluation_session_id','id');
    }
    public function staff(){
        return $this->belongsTo('App\Models\Employee');
    }
    public function target_head(){
        return $this->belongsTo('App\Models\Employee');
    }
    public function target_institution(){
        return $this->morphTo();
    }



    public function getStudentAnswersAttribute(){
        $a = AnsweredQuestion::where(['evaluation_session_id'=>$this->id,'target'=>'student'])->get()->groupBy('question_category.id')->transform(function($item, $k) {
            return $item->groupBy('question_id');
        });

        return $a;
    }
    public function getCollegueAnswersAttribute(){
        $a = AnsweredQuestion::where(['evaluation_session_id'=>$this->id,'target'=>'collegue'])->get()->groupBy('question_category.id')->transform(function($item, $k) {
            return $item->groupBy('question_id');
        });
        return $a;
    }
    public function getHeadAnswersAttribute(){
        $a = AnsweredQuestion::where(['evaluation_session_id'=>$this->id,'target'=>'head'])->get()->groupBy('question_category.id')->transform(function($item, $k) {
            return $item->groupBy('question_id');
        });
        return $a;
    }
    public function getColleguesAttribute(){
        $arr = explode(',', $this->target_collegues);
         $ans = [];
         foreach ($arr as $value) {
            array_push($ans, Employee::find($value) );
         }
         return $ans;
    }
    public function getResultsAttribute(){
        return ToEvaluateHelper::result($this);
    }
    public function getGroupsAttribute(){
        $arr2 = explode(',', $this->target_groups);
        $modelgroups = Group::where([
            'institution_id' => $this->target_institution_id,
            'institution_type'=> $this->target_institution_type,
            'batch_year' => $this->target_year,
            'semester' => $this->semester,
            'year' => $this->academic_year
         ])->get();

         $arr4 = [];
         foreach ($modelgroups as $value) {
             if (in_array($value->name,$arr2)) {
                 array_push($arr4, $value);
             }
         }
        return $arr4;
    }
    // protected  static function boot(){
    //   parent::boot();
    //   // self::retrieved(function ($model) {
    //   // });
    //   // self::updated(function($model){
    //   //   $model->groups = null;
    //   //   $model->collegues = null;
    //   // });
    // }
    
}
