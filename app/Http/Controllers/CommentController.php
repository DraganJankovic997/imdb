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

    public function getComments($id)
    {
        return Movie::findOrFail($id)
            ->comments()
            ->with('user')
            ->paginate(5);
    }

    public function addComment(CreateComment $request, $id)
    {
        $data = array_merge([ 'user_id' => Auth::id(), 'movie_id' => $id ], $request->validated());
        Comment::create($data);
        $data['user'] = Auth::user();
        return $data;
    }


}
