<?php

namespace Modules\StaffEvaluation\Entities;

use Illuminate\Database\Eloquent\Model;

class HeadEvaluation extends Model
{
	protected $table = "ses-head_evaluations";
    protected $fillable = ['id','staff_id','evaluation_session_id'];
}
