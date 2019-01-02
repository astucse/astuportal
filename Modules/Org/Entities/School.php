<?php

namespace Modules\Org\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Org\Entities\Office;
class School extends Model
{
    protected $table = "org-schools";
    protected $fillable = ['name','code','option','description'];
    // public $table_attributes = ['name','code'];
    // public $table_attribute_relations = ['name','code'];
    // public function groups(){
    //     return $this->morphMany('Modules\Org\Entities\Group', 'institution');
    // }
    public function departments(){
        return $this->hasMany('Modules\Org\Entities\Department');
    }
    public function roles(){
        return $this->morphMany('App\Role', 'rolegiver');
    }

    public function getOfficeAttribute(){
        // return "ss";
        foreach (Office::all() as $office) {
            $type =  $office->option['institution_type']; 
            $id =  $office->option['institution_id'];
            if($type == "Org\\School" && $id == $this->id){
                return $office;
            }
        }
        return null;
    }

}
