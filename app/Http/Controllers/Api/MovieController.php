<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with('genre') -> paginate(10);
        foreach($movies as $movie) {
            $movie['emotesCount'] = $movie->countEmotes();

        }
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMovie $request)
    {
        return Movie::create($request->validated());
    }

    public function show($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        $movie->increment('views');
        $movie['emotesCount'] = $movie->countEmotes();
        return $movie;
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        return $movie;
    }

    public function destroy($id)
    {
        //
    }
}
