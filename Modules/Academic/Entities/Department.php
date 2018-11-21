<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "academic-departments";

    protected $fillable = ['school_id','name','code'];

    public $table_attributes = ['name','code','school'];
    public $table_attribute_relations = ['name','code','school.name'];

    
    public function school(){
        return $this->belongsTo('Modules\Academic\Entities\School');
    }


    public function groups(){
        return $this->morphMany('Modules\Academic\Entities\Group', 'institution');
    }

    public function roles(){
        return $this->morphMany('App\Role', 'rolegiver');
    }

}
