<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Resources\CommentCollection;

class SubscribedCommentsController extends Controller
{
    public function __invoke(): CommentCollection
    {
        $user = auth()->user();
        return new CommentCollection($user->subscribedComments);
    }
}
