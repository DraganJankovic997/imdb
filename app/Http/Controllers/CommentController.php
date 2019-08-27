<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComment;
use Illuminate\Http\Request;
use App\Comment;
use App\Movie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    public function getComments($movie_id)
    {
        return Movie::findOrFail($movie_id)
            ->comments()
            ->with('user')
            ->paginate(5);
    }

    public function addComment(CreateComment $request, $movie_id)
    {
        $data = array_merge([ 'user_id' => Auth::id(), 'movie_id' => $movie_id ], $request->validated());
        $c = Comment::create($data);
        $c->load('user');
        return $c;
    }


}
