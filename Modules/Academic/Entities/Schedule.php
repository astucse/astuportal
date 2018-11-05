<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Schedule extends Model
{
    protected $fillable = ['group_id','course_id','day','start','end','uuid'];
    public function course(){
        return $this->belongsTo('Modules\Academic\Entities\Course');
    }
    public function group(){
        return $this->belongsTo('Modules\Academic\Entities\Group');
    }
    public function getStartsAttribute(){
	    $date = new Carbon($this->start);
	    return $date->toTimeString();
	}
	public function getEndsAttribute(){
	    $date = new Carbon($this->end);
	    return $date->toTimeString();
	}
    protected $casts = [
	    'start' => 'H:i',
	];
}
