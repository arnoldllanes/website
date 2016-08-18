<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     *  Attributes that are mass assignable.
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Tags can be associated with many articles.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
