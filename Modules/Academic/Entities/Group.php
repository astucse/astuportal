<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','batch_year','semester','year','freshman','school','institution_id','institution_type'];
    public $table_attributes = ['name','freshman','pre-school','institution'];
    public $table_attribute_relations = ['name','freshman','school','institution.name'];

    public function institution(){
        return $this->morphTo('institution');
    }

    public function enrollments(){
        return $this->hasMany('Modules\Academic\Entities\Enrollment');
    }

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
