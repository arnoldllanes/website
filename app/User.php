<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user can be associated with many presentations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presentations()
    {
        return $this->hasMany('App\Models\Presentation', 'user_id');
    }

    /**
     * Retrieve user gravatar based off of their email.
     */

    public function getAvatarUrl()
    {
        $md5Email = md5($this->email);
        return "https://www.gravatar.com/avatar/". $md5Email . "?d=mm&s=60";
    }

    /**
     * Returns true or false if the user has liked a comment. 
     *
     * @return boolean
     */
    public function hasLikedComment(Models\Comment $comment)
    {
        return (bool) $comment->likes->where('user_id', $this->id)->count();
    }

    /**
     * A user is associated with many likes to comments.
     *
     * \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }
}
