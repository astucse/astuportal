<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedRole extends Model
{
    protected $table = "astu-role_user";
    protected $fillable = ['role_id','roletaker_id','roletaker_type','rolegiver_id','rolegiver_type'];

    public function role(){
        return $this->belongsTo('App\Models\Role')->withDefault();
    }
    public function roletaker(){
        return $this->morphTo();
        return $this->morphTo()->withDefault();
    }
    public function rolegiver(){
        return $this->morphTo()->withDefault();
    }

}
