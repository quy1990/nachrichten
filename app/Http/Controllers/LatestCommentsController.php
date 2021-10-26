<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentCollection;
use App\Models\Comment;


class LatestCommentsController extends Controller
{
    public function __invoke(): CommentCollection
    {
        return new CommentCollection(Comment::paginate(5));
    }
}
