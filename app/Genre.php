<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    const GENRE_ACTION = 'Action';
    const GENRE_ADVENTURE = 'Adventure';
    const GENRE_SPORTS = 'Sports';
    const GENRE_COMEDY = 'Comedy';
    const GENRE_HORROR = 'Horror';
    const GENRE_DOCUMENTARY = 'Documentary';
    const GENRE_THRILLER = 'Thriller';

    public $timestamps = false;

    public function movies() {
        return $this->hasMany('App\Movie');
    }
}
