<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emote extends Model
{
    const EMOTES = ['Like', 'Dislike'];

    public function reactions(){
        return $this->belongsToMany('App\Movie', 'reactions');
    }

    public function countLikes($movie_id) {
        return $this
            ->belongsToMany('App\Movie', 'reactions')
            ->where('movie_id', $movie_id)
            ->count();
    }
}
