<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function movie(){
        return $this->belongsTo('App\Movie');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
