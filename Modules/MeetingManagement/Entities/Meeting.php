<?php

namespace Modules\MeetingManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
	protected $table ="meeting-management-meetings";
    protected $fillable = ['raised_by_id','decision','active','planned_time','group_id','title'];
    public function group(){
        return $this->belongsTo('Modules\MeetingManagement\Entities\Group','group_id');
    }
    public function raised_by(){
        return $this->belongsTo('App\Models\Employee','raised_by_id');
    }
    public function agendas(){
        return $this->hasMany('Modules\MeetingManagement\Entities\Agenda');
    }
    public function participants(){
        return $this->belongsToMany('App\Models\Employee','meeting-management-participants','meeting_id','member_id')->withPivot('signed');
    }
    protected $casts = [
	    // 'planned_time' => 'datetime:Y-m-d H-m-s',
	];
}
