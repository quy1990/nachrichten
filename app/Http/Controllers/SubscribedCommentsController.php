<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentCollection;


class SubscribedCommentsController extends Controller
{
    public function __invoke(): CommentCollection
    {
        $user = auth()->user();
        return new CommentCollection($user->subscribedComments);
    }
}
