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

    public function getMovieComments($movie_id)
    {
        $movie_comments = Movie::find($movie_id)
            ->comments()
            ->with('user')
            ->paginate(5);
        foreach($movie_comments as $com) {
            $com['subcomments'] = $com->comments()->with('user')->get();
        }
        return $movie_comments;
    }
    
    public function addMovieComment(CreateComment $request, $movie_id)
    {
        $data = array_merge([ 'user_id' => Auth::id(),
                            'parent_id' => $movie_id,
                            'parent_type' => 'App\Movie']
                            , $request->validated());
        Comment::create($data);
        return $this->getAllMovieComments($movie_id);
    }

    public function addSubComments(CreateComment $request, $comment_id) {
        $data = array_merge([ 'user_id' => Auth::id(),
                            'parent_id' => $comment_id,
                            'parent_type' => 'App\Comment']
                            , $request->validated());
        Comment::create($data);
        $comment = Comment::findOrFail($comment_id);
        return $this->getAllMovieComments($comment->parent_id);
    }

    public function getAllMovieComments($movie_id){
        $movie_comments = Movie::find($movie_id)
            ->comments()
            ->with('user')
            ->get();
        foreach($movie_comments as $com) {
            $com['subcomments'] = $com->comments()->with('user')->get();
        }
        return $movie_comments;
    }
}
