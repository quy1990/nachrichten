<?php

namespace Modules\Subscribe\Http\Controllers;

use Modules\Post\Resources\PostCollection;
use Modules\User\Http\Controllers\Controller;

class SubscribedUsersController extends Controller
{
    public function __invoke(): PostCollection
    {
        $user = auth()->user();
        return new PostCollection($user->subscribedUsers);
    }
}
