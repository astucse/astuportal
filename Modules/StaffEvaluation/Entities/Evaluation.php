<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['id','name','target'];

    public function questions(){
        return $this->hasMany('Modules\StaffEvaluation\Entities\Question');
    }
}
