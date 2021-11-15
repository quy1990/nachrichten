<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;
use Modules\Comment\Entities\Comment;
use Modules\Comment\Resources\CommentCollection;
use Modules\Comment\Resources\CommentResource;

class CommentController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Comment::class, 'comment');
    }

    public function index(): CommentCollection
    {
        return new CommentCollection(Comment::paginate(20));
    }

    public function store(Request $request): CommentResource
    {
        $comment = new Comment();
        $comment->body = $request->get('body');
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
        $comment->body = $request->get('body');
        $comment->save();
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response("", Status::HTTP_NO_CONTENT);
    }
}
