<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    /**
     *  Attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'body',
        'presenter_id',
        'published_at',
        'edited_by',
        'edited_date',
        'video_embed',
        'approved'
    ];

    protected $dates = ['published_at'];

    /**
     * Scope to modify query instance to return presentations that have been published according to date.
     * Article::published($value);
     *
     * @return $query
     */

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope to modify query isntance to return presentations that have NOT been published according to date
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    /**
     * Mutate the published_at field.
     *
     * @return $date
     */
    public function setPublishAtAttribute($date)
    {
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
     * Publisher of the presentation.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     *  Author of presentation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function presenter()
    {
        return $this->belongsTo('App\Models\Presenter', 'presenter_id');
    }

    /**
     * An presentation can have many tags.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongstoMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    /**
     * Fetches a list of all tags associated with this presentation.
     *
     * @return tags
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();
    }

    /**
     * A presentation can have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
