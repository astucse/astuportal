<?php

namespace App\Models;

use App\Models\AssignedRole;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'id', 'id_number', 'name', 'email', 'password', 'initial_password', 'disability', 'sex'
    ];
    public function roles(){
        return $this->morphMany('App\Models\AssignedRole', 'roletaker');
    }

    public function meeting_groups(){
        return $this->belongsToMany('Modules\MeetingManagement\Entities\Group','meeting-management-group-members','member_id','group_id');
    }

    // public function administrator(){
    //     return $this->morphTo();
    // }
    protected  static function boot(){
      parent::boot();
      self::retrieved(function ($model) {
        $ids = collect($model->roles()->get())->pluck('role_id');
        $dep_head = Role::where(['code'=>'A_DHN'])->first()->id;
        $school_dean = Role::where(['code'=>'A_SDN'])->first()->id;
        $model->isDepartmentHead =  $ids->contains($dep_head);
        $model->isSchoolDean =  $ids->contains($school_dean);
        if($model->isDepartmentHead){

            $model->myInstitution = AssignedRole::where(['role_id'=>$dep_head, 'roletaker_id' => $model->id,'roletaker_type' => 'employee' ])->get()[0]->rolegiver()->first();
        }
     });
  }
}
