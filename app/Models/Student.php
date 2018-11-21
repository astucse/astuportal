<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = "astu-students";
    protected $fillable = [
        'id', 'id_number', 'name', 'email', 'password', 'initial_password', 'disability','graduated','batch_year', 'sex'
    ];

    public function roles(){
        return $this->morphMany('App\Models\AssignedRole', 'roletaker');
    }
    public function enrollments(){
        return $this->hasMany('Modules\Academic\Entities\Enrollment');
    }
    // public function group(){
        // return $this->hasMany('Modules\Academic\Entities\Enrollment');
        // return $this->hasMany('Modules\Academic\Entities\Enrollment')->get()[0];
    // }

    public function filled_evaluation_sessions(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\EvaluationSession', 'student_id', 'evaluation_session_id');
    }

    public function getOriginalPasswordAttribute(){
        if (Hash::check($this->initial_password, $this->password)) {
            return true;
        }
        return false;
    }
    public function getGroupAttribute(){
        $g = null;
        foreach ($this->enrollments as $e) {
            if($e->group->semester == 1 && $e->group->year == 2011){
               $g = $e->group; 
            }
        }
        return $g;
    }


}
