<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	protected $table = "academic-assignments";
    protected $fillable = [
    	'academic_year','semester','course_id','instructor_id','group_id', 'batch_year', 'institution_id', 'institution_type'
    ];

    public function group(){
        return $this->belongsTo('Modules\Academic\Entities\Group');
    }
    public function course(){
        return $this->belongsTo('Modules\Academic\Entities\Course');
    }
    public function instructor(){
        return $this->belongsTo('App\Models\Employee');
    }

}
