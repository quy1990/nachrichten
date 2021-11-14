<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Resources\PostCollection;
use Modules\User\Entities\User;

class PostUserController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(User::find($id)->posts);
    }
}
