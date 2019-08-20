<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emote extends Model
{
    const EMOTES = ['Like', 'Dislike'];
    public function emote(){
        return $this->hasMany('App\Reaction');
    }
}
