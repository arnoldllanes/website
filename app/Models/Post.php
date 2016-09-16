<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $fillable = [
	    'title',
	    'body',
	    'published_at',
        'approved'
    ];

	protected $dates = ['published_at'];
	/**
	 * Owner of the post.
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function owner()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }


    public function scopePublished($query){
    	$query->where('published_at', '<=', Carbon::now());
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();    
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
