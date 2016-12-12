<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    public function users(){
        return $this->belongsTo('App\User', 'id');
    }
    public function authorizations(){
        return $this->belongsToMany('App\Authorization', 'auth_id');
    }
}
