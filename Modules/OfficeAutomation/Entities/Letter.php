<?php

namespace Modules\OfficeAutomation\Entities;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = ["title","body","tags","categories","owner","to","cc","status"];
    
}
