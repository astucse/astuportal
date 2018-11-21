<?php

namespace Modules\Academic\Entities;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\Elective;
use Illuminate\Database\Eloquent\Model;

class CourseBreakdown extends Model
{
    protected $table = "academic-course_breakdowns";

    protected $fillable = [
        'year','semester','institution_id','institution_type','courses','electives','curriculum_id'
    ];

    public function getCoursessAttribute(){
    	$arr = explode(',', $this->courses);
        $ans = [];
        foreach ($arr as $value) {
            if(Course::where('code',$value)->count()==0){
                array_push($ans, Course::find(1));
            }else{
                array_push($ans, Course::where('code',$value)->first());
            }
        }

    	if( sizeof($ans)==1 && $ans[0]==null ){
            return [];
        }
        return Collect($ans);
    }
    public function getElectivessAttribute(){
        $arr = explode(',', $this->electives);
        $ans = [];
        foreach ($arr as $value) {
            if(Elective::where('code',$value)->first()!=null)
                array_push($ans, Elective::where('code',$value)->first());
        }
        if( sizeof($ans)==1 && $ans[0]==null ){
            return [];
        }
        return Collect($ans);
    }
    public function getAllCoursessAttribute(){
        $ans  = $this->coursess;
        foreach ($this->electivess as $elective) {
            $ans = $ans->merge($elective->coursess);
        }
        return $ans->unique();
    }
    public function getTotalCrhrAttribute(){
    	$k = $this->Coursess->reduce(function ($carry, $item) {
		    return $carry + $item->crhr;
		});
		$k2 = $this->Electivess->reduce(function ($carry, $item) {
		    return $carry + $item->crhr;
		});

    	return $k+$k2;
    }
}
