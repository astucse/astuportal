<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\StaffEvaluation\Entities\Category;
class Evaluation extends Model
{
    protected $table = "ses-evaluations";
    protected $fillable = ['id','name','target'];

    public function questions(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\Question');
    }
    public function getQuestionsByCategoryAttribute(){
    	$gg = $this->questions->groupBy('question_category_id');
    	$ggg = [];
    	foreach ($gg as $key => $value) {
    		// $key = $key+1;
    		$ggg[Category::find($key)->name] = $value;
    	}
    	return $ggg;
    }
}
