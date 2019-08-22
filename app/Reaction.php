<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $primaryKey = 'movie_id';

    public function emote(){
        return $this->belongsTo('App\Emote');
    }
}
