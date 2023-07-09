<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function create()
    {
        $request->validate(["content" => "required"]);


        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if(Gate::allows('delete-comment', $comment)) {
            $comment->delete();
            return back()->with('info', 'A comment deleted');
        }

        return back()->with('info', 'Unauthorize to delete');
    }
}
