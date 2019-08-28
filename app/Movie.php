<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $guarded = ['id'];

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genre_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany('App\Reaction');
    }

    //izvuces emote::all, izvuces movie->reactions->with(emotes)
    //uradis emotes->map(vracas [emote_name]=>count(filter(po_emote_name))')

    public function countEmotes($emotes)
    {
        $reactions = $this->reactions()->get();
        $list = [];
        $emotes->map(function ($e) use ($reactions, &$list) {
            $list[$e->name] = count($reactions->filter(function($react) use ($e) {
                return $react->emote_id == $e->id;
            }));
        });
        $this['emotes'] = $list;   
    }
    public function comments() {
        return $this->morphMany('App\Comment', 'parent');
    }

    public function didWatch($user_id){
        return WatchList::where([
            'movie_id' => $this->id , 
            'user_id' => $user_id ])
            ->first();
    }

    public function checkIfWatched($user_id)
    {
        if($this->didWatch($user_id)) {
            $this['watched'] = true;
        } else {
            $this['watched'] = false;
        }
    }
}
