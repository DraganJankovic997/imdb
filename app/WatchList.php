<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function movies(){
        return $this->belongsTo('App\Movie');
    }
    public function users(){
        return $this->belongsTo('App\User');
    }

}
