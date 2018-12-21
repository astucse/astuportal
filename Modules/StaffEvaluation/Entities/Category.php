<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = "ses-categories";
    protected $fillable = ['id','name'];
}
