<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentCollection;
use App\Models\Comment;
use App\Models\User;

class CommentUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function __invoke(int $id): CommentCollection
    {
        return new CommentCollection(User::find($id)->comments);
    }
}
