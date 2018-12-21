<?php

namespace Modules\Academic\Entities;
use Modules\Academic\Entities\Course;
use Illuminate\Database\Eloquent\Model;

class Elective extends Model
{
	protected $table = "academic-electives";
    protected $fillable = ['options','crhr','courses','type','code'];
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
}
