<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_english','question_amharic','type','evaluation_id','question_category_id',];
    public function category(){
        return $this->belongsTo('Modules\StaffEvaluation\Entities\Category','question_category_id');
    }
}
