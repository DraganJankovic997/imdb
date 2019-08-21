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
        $final_array = [];
        foreach($movie_array as $movie_id) {
            $b;
            $temp = WatchList::where([
                ['movie_id', $movie_id],
                ['user_id', Auth::id()],
                ])->first();
    
            if($temp == null) 
            {
                $b = false;
            }
            else 
            {
                $b = true;
            }
            $final_array[] = [
                'movie_id' => $movie_id,
                'watched' => $b
            ];
        }
        
        return $final_array;
    }

    public function popular()
    {
        return Movie::orderBy('views', 'desc')
            ->take(10)
            ->get();
    }

    public function related($id) 
    {
         
    }
}
