<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
    protected $fillable = ['name', 'email', 'website'];

    /**
     * Presenter is associated to author many articles.
     */
    public function myPresentations()
    {
        return $this->hasMany('App\Models\Presentation', 'presenter_id');
    }

    public function articleCount()
    {
        return $this->myPresentations()->count();
    }
}
