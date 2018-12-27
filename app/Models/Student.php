<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\OptionsHelper;
class Student extends Authenticatable
{
    protected $table = "astu-students";
    protected $fillable = [
        'id', 
        'id_number', 
        'name', 
        'email', 
        'password', 'initial_password', 'disability','graduated','batch_year', 'sex'
    ];

    public function roles(){
        return $this->morphMany('App\Models\AssignedRole', 'roletaker');
    }
    public function enrollments(){
        return $this->hasMany('Modules\Academic\Entities\Enrollment');
    }


    public function filled_evaluation_sessions(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\EvaluationSession', 'student_id', 'evaluation_session_id');
    }

    public function getOriginalPasswordAttribute(){
        if (Hash::check($this->initial_password, $this->password)) {
            return true;
        }
        return false;
    }

    public function getMyInstitutionAttribute(){
        if ($this->group != null) {
            return $this->group->institution;
        }
        return null;
    }
    //     $g = null;
    //     foreach ($this->enrollments as $e) {
    //         if($e->group->semester == 1 && $e->group->year == 2011){
    //            $g = $e->group->name; 
    //         }
    //     }
    //     return $g;
    //     $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
    //     $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
    //     if($this->isDepartmentHead){
    //         return AssignedRole::where(['role_id'=>$dep_head, 'roletaker_id' => $this->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
    //     }
    //     if($this->isSchoolDean){
    //         return AssignedRole::where(['role_id'=>$school_dean, 'roletaker_id' => $this->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
    //     }
    //     return null;
    // }

    public function getGroupAttribute(){
        $g = null;
        foreach ($this->enrollments as $e) {
            if($e->group->semester == OptionsHelper::current_semester() && $e->group->year == OptionsHelper::current_year()){
               $g = $e->group; 
            }
        }
        return $g;
    }
}
