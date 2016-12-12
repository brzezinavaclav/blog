<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['title', 'description', 'slug'];

    public function Posts()
    {
    	return $this->belongsToMany('App\Post');
    }
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}
