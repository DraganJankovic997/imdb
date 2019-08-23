<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use App\Movie;

class GenreController extends Controller
{
    public function getAll()
    {
        return Genre::get();
    }
}
