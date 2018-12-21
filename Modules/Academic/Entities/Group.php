<?php

namespace Modules\Academic\Entities;
use Modules\Academic\Entities\Curriculum;
use Modules\Academic\Entities\Schedule;
use Modules\Academic\Entities\CourseBreakdown;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "academic-groups";

    protected $fillable = [
        'name','batch_year','semester','year','freshman','school','institution_id','institution_type','curriculum_id'
    ];

    public $table_attributes = ['name','freshman','pre-school','institution'];
    public $table_attribute_relations = ['name','freshman','school','institution.name'];

    public function institution(){
        return $this->morphTo('institution');
    }

    public function enrollments(){
        return $this->hasMany('Modules\Academic\Entities\Enrollment');
    }
    public function schedules(){
        return $this->hasMany('Modules\Academic\Entities\Schedule');
    }
    public function getBreakdownAttribute(){
        // $this->batch_year;
        $c =    Curriculum::all()->random();
        $b = CourseBreakdown::where([
            'year' => $this->batch_year,
            'semester'=> $this->semester, 
            'institution_id' => $this->institution_id, 
            'institution_type' => $this->institution_type, 
            'curriculum_id' => $c->id
        ])->first();
        return $b;
        return $this->belongsTo('Modules\Academic\Entities\Curriculum');
    }
    // public function getScheduleByDayAttribute($day){
    //     return $this->schedules;
    // }

    protected $casts = [
        'freshman' => 'boolean',
        'school' => 'boolean',
    ];
    public function getGregorianYearAttribute(){
    	$y1 = $this->year + 7;
    	$y2 = $this->year + 8;
	    return "{$y1} / {$y2}";
	}
}
