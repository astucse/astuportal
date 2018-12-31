<?php

namespace Modules\Registration\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassroomGroup extends Model
{
    protected $table ='registration-classroom_groups';
    protected $fillable = [
        'name','batch_year','semester','year',
        'preengineering','prescience','school',
        'institution_id','institution_type'
    ];
    public function institution(){
        return $this->morphTo('institution');
    }
    public function enrollments(){
        return $this->hasMany('Modules\Registration\Entities\StudentEnrollment','group_id');
    }
    public function assignments(){
        return $this->hasMany('Modules\Registration\Entities\InstructorAssignment');
    }
    // public function getGetInstitution(){
    //     return "d";
    // } 
    
    // public function getBreakdownAttribute(){
    //     $c =    Curriculum::all()->random();
    //     $b = CourseBreakdown::where([
    //         'year' => $this->batch_year,
    //         'semester'=> $this->semester, 
    //         'institution_id' => $this->institution_id, 
    //         'institution_type' => $this->institution_type, 
    //         'curriculum_id' => $c->id
    //     ])->first();
    //     return $b;
    //     return $this->belongsTo('Modules\Academic\Entities\Curriculum');
    // }

    protected $casts = [
        'preengineering' => 'boolean',
        'prescience' => 'boolean',
        'school' => 'boolean',
    ];
    public function getGregorianYearAttribute(){
    	$y1 = $this->year + 7;
    	$y2 = $this->year + 8;
	    return "{$y1} / {$y2}";
	}
}
