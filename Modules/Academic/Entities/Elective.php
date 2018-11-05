<?php

namespace Modules\Academic\Entities;
use Modules\Academic\Entities\Course;
use Illuminate\Database\Eloquent\Model;

class Elective extends Model
{
    protected $fillable = ['options','crhr','courses','type'];
    public function getCoursessAttribute(){
    	$arr = explode(',', $this->courses);
    	return Course::find($arr);
    }
}
