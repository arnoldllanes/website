<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
	protected $fillable = [ 'name', 'email' ];
    /**
     * Presenter is associated to author many articles.
     */
    public function myArticles()
    {
    	return $this->hasMany('App\Article', 'presenter_id');
    }
}
