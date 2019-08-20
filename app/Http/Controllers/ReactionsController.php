<?php

namespace App\Http\Controllers;

use App\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Emote;
use Illuminate\Support\Facades\Auth;


class ReactionsController extends Controller
{
    public function react(Request $request) {
        $data = array_merge(['user_id' => Auth::id()], $request->all());
        $old = Reaction::where('user_id', $data['user_id'])->where('movie_id', $data['movie_id'])->first();
        if( $old === null) {
            return Reaction::create($data);
        } else {
            return 'You already rated this movie';
        }
    }

    public function reactions($id){
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
}
