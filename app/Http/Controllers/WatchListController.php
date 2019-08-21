<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\WatchList;

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

    public function popular()
    {

    }

    public function related($id) 
    {
        
    }
}
