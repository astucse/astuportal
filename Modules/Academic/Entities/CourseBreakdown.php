<?php

namespace Modules\Academic\Entities;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\Elective;
use Illuminate\Database\Eloquent\Model;

class CourseBreakdown extends Model
{
    protected $fillable = ['year','semester','institution_id','institution_type','courses','electives','curriculum_id'];

    public function getCoursessAttribute(){
    	$arr = explode(',', $this->courses);
    	return Course::find($arr);
    }
    public function getElectivessAttribute(){
    	$arr = explode(',', $this->electives);
    	return Elective::find($arr);
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
