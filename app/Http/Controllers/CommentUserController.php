<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentCollection;

class CommentUserController extends Controller
{
    public function __invoke(): CommentCollection
    {
        return new CommentCollection(auth()->user()->comments);
    }
}
