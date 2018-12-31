<?php

namespace Modules\Org\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "org-departments";
    protected $fillable = ['school_id','name','code','option','description'];

    // public $table_attributes = ['name','code','school','description'];
    // public $table_attribute_relations = ['name','code','school.name'];
    
    public function school(){
        return $this->belongsTo('Modules\Org\Entities\School');
    }

    // public function groups(){
    //     return $this->morphMany('Modules\Org\Entities\Group', 'institution');
    // }

    public function roles(){
        return $this->morphMany('App\Role', 'rolegiver');
    }

}
