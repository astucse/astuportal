<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use App\Models\AssignedRole;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $table = "astu-employees";
    protected $fillable = [
        'id_number', 'name', 'email', 'password', 'initial_password', 'disability', 'sex'
    ];
    public function roles(){
        return $this->morphMany('App\Models\AssignedRole', 'roletaker');
    }

    public function meeting_groups(){
        return $this->belongsToMany('Modules\MeetingManagement\Entities\Group','meeting-management-group-members','member_id','group_id');
    }

    public function assignments(){
        return $this->hasMany('Modules\Academic\Entities\Assignment');
    }

    public function getOriginalPasswordAttribute(){
        if (Hash::check($this->initial_password, $this->password)) {
            return true;
        }
        return false;
    }

    public function getMyInstitutionAttribute(){
        $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
        $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
        if($this->isDepartmentHead){
            return AssignedRole::where(['role_id'=>$dep_head, 'roletaker_id' => $this->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
        }
        if($this->isSchoolDean){
            return AssignedRole::where(['role_id'=>$school_dean, 'roletaker_id' => $this->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
        }
        return null;
    }
    public function getIsDepartmentHeadAttribute(){
        $ids = collect($this->roles()->get())->pluck('role_id');
        $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
        return $ids->contains($dep_head);
    }
    public function getIsSchoolDeanAttribute(){
        $ids = collect($this->roles()->get())->pluck('role_id');
        $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
        return $ids->contains($school_dean);
    }

    public function getPerformanceAttribute(){
        $collection = \Modules\StaffEvaluation\Entities\EvaluationSession::where(['staff_id'=>$this->id])->get();
        $c = $collection->groupBy(['academic_year','semester']);
        foreach ($c as $years) {
            foreach ($years as $semesters) {
                $value = 0;
                foreach ($semesters as $evaluation) {
                    $value+=$evaluation->results['all'];
                }
                if(sizeof($semesters)==0)
                    $semesters['result'] = 0;
                else
                    $semesters['result'] = $value/sizeof($semesters);
            }
        }
        return $c;
        // return Modules\StaffEvaluation\Entities\EvaluationSession::where(['staff_id'=>Auth::user()->id])->groupBy('academic_year');
        // return $collection->groupBy(function ($item, $key) {
            // return $item->academic_year;
            // return $item->groupBy(function ($item, $key) {
            //     return "";
            // });
         // });

        // $ids = collect($this->roles()->get())->pluck('role_id');
        // $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
        // return $ids->contains($school_dean);
    }
    // public function getMyInstitutionAttribute(){
    //     $ids = collect($model->roles()->get())->pluck('role_id');
    //     $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
    //     $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
    //     AssignedRole::where(['role_id'=>$dep_head, 'roletaker_id' => $model->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
    // }

    // public function administrator(){
    //     return $this->morphTo();
    // }
    // protected  static function boot(){
     //  parent::boot();
     //  self::retrieved(function ($model) {
     //    $ids = collect($model->roles()->get())->pluck('role_id');
     //    $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
     //    $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
     //    $model->isDepartmentHead =  $ids->contains($dep_head);
     //    $model->isSchoolDean =  $ids->contains($school_dean);
     //    if($model->isDepartmentHead){
     //        $model->myInstitution = AssignedRole::where(['role_id'=>$dep_head, 'roletaker_id' => $model->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
     //    }
     // });
  // }
}
