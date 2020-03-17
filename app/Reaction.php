<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $primaryKey = 'id';

    public function emotes(){
        return $this->belongsTo('App\Emote');
    }
}
