<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $fillable = [ 'user_id' ];

	/**
     * Get all of the likeable models.
     */
    public function likeable()
	{
		return $this->morphTo();
	}


	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
