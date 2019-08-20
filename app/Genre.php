<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    const GENRES=['Action', 'Adventure', 'Sports', 'Comedy', 'Horror', 'Documentary', 'Thriller'];

    public $timestamps = false;

    public function genre() {
        return $this->belongsTo('App\Genre');
    }
}
