<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['movie_id', 'user_id', 'emote_id'];
    public $timestamps = false;

    public function emote(){
        return $this->belongsTo('App\Emote');
    }
}
