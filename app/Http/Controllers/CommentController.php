<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    protected function validator($data)
    {
        return Validator::make($data, [
            'content' => 'required|max:500',
        ]);
    }



    public function getComments($id)
    {
        $comments = Comment::where('movie_id', $id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('movie_id', 'users.name as author', 'content')
            ->paginate(5);
            


        return $comments;
        return Comment::where('movie_id', $id)->paginate(5);
    }

    public function addComment(Request $request, $id)
    {
        $data = array_merge([ 'user_id' => Auth::id(), 'movie_id' => $id ], $request->all());
        $val = $this->validator($data);
        if($val->fails()) 
        {
            return $val->messages();
        }
        else
        {
            return Comment::create($data);
        }
        

    }


}
