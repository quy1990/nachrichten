<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use Modules\Category\Entities\User;

class PostUserController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(User::find($id)->posts);
    }
}
