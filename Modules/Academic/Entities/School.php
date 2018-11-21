<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	protected $table = "academic-schools";

    protected $fillable = ['name'];
    public $table_attributes = ['name','code'];
    public $table_attribute_relations = ['name','code'];
    public function groups(){
        return $this->morphMany('Modules\Academic\Entities\Group', 'institution');
    }
    public function roles(){
        return $this->morphMany('App\Role', 'rolegiver');
    }
    
}
