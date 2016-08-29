<?php

namespace App\Models;

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
     * Tags can be associated with many presentations.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function presentations()
    {
        return $this->belongsToMany('App\Models\Presentation');
    }
}
