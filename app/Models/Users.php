<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    //
    public function userRestrict()
    {
       return $this->hasOne('App\Models\UserRestrict');
    }

    public $timestamps = false;
}
