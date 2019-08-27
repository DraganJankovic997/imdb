<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use App\Emote;



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
        $emotes = Emote::all();
        foreach($movies as $movie) {
            $movie->countEmotes($emotes);
            $movie->checkIfWatched(Auth::id());
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
        $emotes = Emote::all();
        $movie->countEmotes($emotes);
        $movie->checkIfWatched(Auth::id());
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
