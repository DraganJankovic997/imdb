<?php

namespace App\Http\Controllers;

use App\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Emote;
class ReactionsController extends Controller
{
    public function react(Request $request) {
        
        return Reaction::create($request->all());
    }

    public function reactions($id){
        return Reaction::where('movie_id', $id)
            ->join('emotes as e', 'e.id', '=', 'reactions.emote_id')
            ->select('movie_id', 'e.name', DB::raw('count(*) as reaction_count'))
            ->groupBy('e.name')
            ->groupBy('movie_id')
            ->get();    
    }
}
