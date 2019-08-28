<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    const PARENT_TYPES = ['App\Movie', 'App\Comment'];
    public $timestamps = false;
    protected $guarded = ['id'];

    public function parent(){
        return $this->morphTo('parent');
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'parent');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
