<?php

namespace Modules\Subscribe\Http\Controllers;

use Modules\Post\Resources\PostCollection;
use App\Http\Controllers\Controller;

class SubscribedUsersController extends Controller
{
    public function __invoke(): PostCollection
    {
        $user = auth()->user();
        return new PostCollection($user->subscribedUsers);
    }
}
