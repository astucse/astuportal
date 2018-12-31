<?php

namespace Modules\Registration\Entities;

use Illuminate\Database\Eloquent\Model;

class InstructorAssignment extends Model
{
    protected $table ='registration-instructor_assignments';
    protected $fillable = [
    	'academic_year','semester','course_id','instructor_id','group_id', 'batch_year', 'institution_id', 'institution_type'
    ];

    public function group(){
        return $this->belongsTo('Modules\Registration\Entities\Group');
    }
    public function course(){
        return $this->belongsTo('Modules\Academic\Entities\Course');
    }
    public function instructor(){
        return $this->belongsTo('App\Models\Employee','instructor_id');
    }
}
