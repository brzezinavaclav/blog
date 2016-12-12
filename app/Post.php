<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'comments', 'type', 'slug'];

    public function Comments()
    {
    	return $this->hasMany('App\Comment');
    }
    public function Categories()
    {
    	return $this->belongsToMany('App\Category');
    }
    public function Author(){
        return $this->belongsTo('App\User');
    }
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}
