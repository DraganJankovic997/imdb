<?php

namespace App\Http\Controllers;

use App\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Emote;
use Illuminate\Support\Facades\Auth;


class ReactionsController extends Controller
{
    public function react(Request $request)
    {
        return Reaction::updateOrCreate(
            ['user_id' => Auth::id(), 'movie_id' => $request->input('movie_id')],
            ['emote_id' => $request->input('emote_id')]
        );
    }

    public function reactions($id)
    {
        $emotes = Emote::all();
        $emotesNumber = $emotes->map(function ($emote) use ($id) {
            return Reaction::where([
                'movie_id' => $id,
                'emote_id' => $emote->id,
            ])
            ->select('movie_id', 'e.name', 'e.id as emote_id', DB::raw('count(*) as reaction_count'))
            ->count();

        });
        $reactions = [
            'movie_id' => $id,
            'emotes' => $emotesNumber
        ];
        return $reactions;
    }



    public function reactionsPage($id)
    {
        $movie_array = range( ($id-1)*10 + 1, ($id*10) );
        $final_array = [];
        $emotes = Emote::all();
        foreach($movie_array as $movie_id) {

            $emotesNumber = $emotes->map(function ($emote) use ($movie_id) {
                return Reaction::where([
                    'movie_id' => $movie_id,
                    'emote_id' => $emote->id,
                ])
                ->select('movie_id', 'e.name', 'e.id as emote_id', DB::raw('count(*) as reaction_count'))
                ->count();
            });

            $final_array[] = [
                'movie_id' => $movie_id,
                'emotes' => $emotesNumber
            ];
        }
        
        return $final_array;
    }
}
