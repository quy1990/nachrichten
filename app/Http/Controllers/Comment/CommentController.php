<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CommentStoreRequest;
use App\Http\Requests\Comments\CommentUpdateRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;

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

    public function store(CommentStoreRequest $request): CommentResource
    {
        $comment = new Comment();
        $comment->body = $request->get('body');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return new CommentResource($comment);
    }

    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    public function update(CommentUpdateRequest $request, Comment $comment): CommentResource
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
