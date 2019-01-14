<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = "astu-roles";
    protected $fillable = ['code','category','description'];

    public function assignment(){
        return $this->hasMany('App\Models\AssignedRole');
        return $this->hasMany('App\Models\AssignedRole');
    }
}
