<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 *  Attributes that are mass assignable.
	 */
    protected $fillable = [
	    'title',
	    'body',
	    'published_at',
    ]; 

    protected $dates = ['published_at'];

    /**
     * Scope to modify query instance to return articles that have been published according to date. 
     * Article::published($value);
     *
     * @return $query
     */
    
    public function scopePublished($query){
    	$query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope to modify query isntance to return articles that have NOT been published according to date
     */
    public function scopeUnpublished($query){
    	$query->where('published_at', '>', Carbon::now());
    }

    /**
     * Mutate the published_at field.
     *
     * @return $date
     */
    public function setPublishAtAttribute($date){
    	$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * Mutate the carbon date format.
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Publisher of the article.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     *  Author of article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function presenter()
    {
        return $this->belongsTo('App\Presenter', 'presenter_id');
    }

    /**
     * An article can have many tags.
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongstoMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Fetches a list of all tags associated with this article.
     *
     * @return tags
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();    
    }
}
