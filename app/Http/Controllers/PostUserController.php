<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use App\Models\User;

class PostUserController extends Controller
{
    public function __invoke(User $user): PostCollection
    {
        return new PostCollection($user->posts);
    }
}
