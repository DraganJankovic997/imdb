<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\WatchList;
use App\Movie;
use Illuminate\Support\Facades\Redis;

class WatchListController extends Controller
{
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
        return WatchList::where([
            ['movie_id', $id],
            ['user_id', Auth::id()],
        ])->delete();
        
    }

    public function popular()
    {
        if ($popular = Redis::get('popular')) {
            return json_decode($popular); 
        } 

        $popular = Movie::orderBy('views', 'desc')
            ->take(10)
            ->get();

        Redis::setex('popular', 60 * 60 * 24, $popular); 
        return $popular;
    }

    public function related($id) 
    {
         return Movie::where('genre_id', $id)
            ->take(10)
            ->get();
    }
}