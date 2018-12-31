<?php

namespace Modules\Registration\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    protected $table ='registration-student_enrollments';
    protected $fillable = ['student_id','group_id','assigned'];
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
    public function group(){
        return $this->belongsTo('Modules\Registration\Entities\ClassroomGroup','group_id');
    }
}
