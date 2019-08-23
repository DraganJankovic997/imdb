<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\WatchList;
use App\Movie;

class WatchListController extends Controller
{
    public function isWatched($id) 
    {
        $temp = WatchList::where([
            ['movie_id', $id],
            ['user_id', Auth::id()],
        ])->first();

        if($temp == null) 
        {
            return 'Not watched';
        }
        else 
        {
            return 'Watched';
        }
    }

    public function watched($id) 
    {
        $temp = WatchList::where([
            ['movie_id', $id],
            ['user_id', Auth::id()],
        ])->first();

        if($temp == null) 
        {
            return WatchList::create([
                'movie_id' => $id,
                'user_id' => Auth::id()
            ]);
        }
        else 
        {
            return WatchList::where([
                ['movie_id', $id],
                ['user_id', Auth::id()],
            ])->delete();
        }
    }

    public function watchedPage($id){
        $movie_array = range( ($id-1)*10 + 1, ($id*10) );
        $movie_array = array_map(function($x) {
            $temp = WatchList::where([
                ['movie_id', $x],
                ['user_id', Auth::id()],
                ])->first();
            return [
                'movie_id' => $x,
                'watched' => ($temp != null) ? true : false
            ];
        }, $movie_array);
        return $movie_array;
    }

    public function popular()
    {
        return Movie::orderBy('views', 'desc')
            ->take(10)
            ->get();
    }

    public function related($id) 
    {
         return Movie::where('genre_id', $id)
            ->take(10)
            ->get();
    }
}