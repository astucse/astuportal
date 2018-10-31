<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code','name','description','crhr'];
}
