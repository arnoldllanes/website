<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'presentation_id',
    	'user_id',
		'body',
		'flagged'
	];

	/**
	 * A comment is associated with a presentation.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function presentation()
	{
		return $this->belongsTo('App\Models\Presentation');
	}

	/**
	 * A comment is made by a user.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	* A parent comment; not a reply to a comment
	*/
	public function scopeNotReply($query)
	{
		return $query->whereNull('parent_id');
	}

	/**
	 * Replies to a comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies()
	{
		return $this->hasMany('App\Models\Comment', 'parent_id');
	}

	/**
     * Get all of the comments likes.
     */
	public function likes()
	{
		return $this->morphMany('App\Models\Like', 'likeable');
	}

	/**
     * Get all of the comments flags.
     */
	public function flags()
	{
		return $this->morphMany('App\Models\Flag', 'flagable');
	}
}
