<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

class CommentController extends Controller
{
    public function index(): CommentCollection
    {
        return new CommentCollection(Comment::paginate(20));
    }

    public function store(Request $request): CommentResource
    {
        $comment = new Comment();
        $comment->name = $request->get('name');
        $comment->user_id = $request->get('user_id');
        $comment->save();
        return new CommentResource($comment);
    }

    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    public function update(Request $request, Comment $comment): CommentResource
    {
        $comment->name = $request->get('name');
        $comment->save();
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
