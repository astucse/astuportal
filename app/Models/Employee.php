<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'id', 'id_number', 'name', 'email', 'password', 'initial_password', 'disability', 'sex'
    ];

    // public function system(){
    //     return $this->belongsTo('App\Models\System');
    // }

    // public function administrator(){
    //     return $this->morphTo();
    // }
}
