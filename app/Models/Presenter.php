<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
    use Searchable;
    
    protected $fillable = ['name', 'email', 'website'];

    /**
     * Presenter is associated to author many articles.
     */
    public function myPresentations()
    {
        return $this->hasMany('App\Models\Presentation', 'presenter_id');
    }

    public function presentationCount()
    {
        return $this->myPresentations()->count();
    }
}
