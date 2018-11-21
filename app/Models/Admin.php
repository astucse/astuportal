<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	protected $table = "astu-admins";

    protected $fillable = [
        'id', 'type', 'email', 'name', 'password'
    ];

    // public function system(){
    //     return $this->belongsTo('App\Models\System');
    // }

    // public function administrator(){
    //     return $this->morphTo();
    // }
}
