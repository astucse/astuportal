<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['student_id','group_id','assigned'];
    public function student(){
        return $this->belongsTo('App\Models\Student');
    }
    public function group(){
        return $this->belongsTo('Modules\Academic\Entities\Group');
    }
}
