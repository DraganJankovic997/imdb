<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Movie extends Model
{

    protected $guarded = ['id'];

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genre_id', 'id');
    }

    public function emotes()
    {
        return $this->belongsToMany('App\Emote', 'reactions');
    }
    public function countEmotes()
    {
        $counted = [];
        foreach(Emote::all() as $emote) {
            $counted[$emote->name] = $emote->countLikes($this->id);
            // array_push($counted, [ $emote->name => $emote->countLikes($this->id) ]);
        }
        return $counted;
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function didWatch(){
        return WatchList::where('movie_id', $this->id)
            ->where('user_id', Auth::id())
            ->first();
    }

}
