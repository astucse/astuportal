<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $table = "academic-courses";
    protected $fillable = ['code','name','description','crhr','prequisite_id','prequisite_id2'];
    public function prerequisite(){
        return $this->belongsTo('Modules\Academic\Entities\Course','prequisite_id','id');
    }
    public function prerequisite2(){
        return $this->belongsTo('Modules\Academic\Entities\Course','prequisite_id2','id');
    }
}
