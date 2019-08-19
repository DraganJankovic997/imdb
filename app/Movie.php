<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function genre()
    {
        return $this->hasOne('App\Genre', 'id', 'genre_id');
    }

    protected $fillable = ['title', 'description', 'image_url', 'genre_id'];

}
