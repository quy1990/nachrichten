<?php

namespace Modules\Comment\Http\Controllers;

use Modules\Comment\Resources\CommentCollection;
use Modules\User\Http\Controllers\Controller;

class SubscribedCommentsController extends Controller
{
    public function __invoke(): CommentCollection
    {
        $user = auth()->user();
        return new CommentCollection($user->subscribedComments);
    }
}
