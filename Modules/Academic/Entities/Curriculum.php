<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
	protected $table = "academic-curricula";
    protected $fillable = ['version','name'];
}
