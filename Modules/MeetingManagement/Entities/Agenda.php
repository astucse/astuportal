<?php

namespace Modules\MeetingManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	protected $table ="meeting-management-agendas";
    protected $fillable = ['body','title','meeting_id','raised_by_id'];

    public function meeting(){
        return $this->belongsTo('Modules\MeetingManagement\Entities\Meeting','meeting_id');
    }
    public function raised_by(){
        return $this->belongsTo('App\Models\Employee','raised_by_id');
    }
}
