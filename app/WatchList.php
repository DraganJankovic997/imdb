<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    public $timestamps = false;
    protected $fillable = ['movie_id', 'user_id'];

}
