<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $table = "astu-options";

    protected $fillable = [
        'code', 'value', 'description', 'parameter_1', 'parameter_2','parameter_3','parameter_4','parameter_5','parameter_6','list'
    ];

    protected $casts = [
        'list' => 'array',
    ];

}
