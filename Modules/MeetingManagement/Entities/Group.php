<?php

namespace Modules\MeetingManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table ="meeting-management-groups";
    protected $fillable = [
        'id', 'name','creator_id', 'admin_id'
    ];
    public function creator(){
        return $this->belongsTo('App\Models\Employee','creator_id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Employee','admin_id');
    }

    public function meetings(){
        return $this->hasMany('Modules\MeetingManagement\Entities\Meeting');
    }

    public function members(){
        return $this->belongsToMany('App\Models\Employee','meeting-management-group-members','group_id','member_id');
    }
}
