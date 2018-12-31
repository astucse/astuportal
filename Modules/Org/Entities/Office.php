<?php

namespace Modules\Org\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Org\Entities\Department;
use Modules\Org\Entities\School;
class Office extends Model
{
    protected $table = "org-offices";
    protected $fillable = ["name","description","option","parent_id"];

    protected $casts = [
        'option' => 'array', // "institution_id", "institution_type" department, office, 
    ];

    public function getInstitutionAttribute(){
        $type =  $this->option['institution_type']; 
        $id =  $this->option['institution_id'];
        if($type == "school"){
            return School::find($id);
        }
        if($type == "department"){
            return Department::find($id);
        }
        return null; 
        // return Department::find(1); 
    }
    public function roles(){
        return $this->morphMany('App\Role', 'rolegiver');
    }   
}
