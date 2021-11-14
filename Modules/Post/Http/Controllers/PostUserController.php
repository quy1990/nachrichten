<?php

namespace Modules\Post\Http\Controllers;

use Modules\Post\Resources\PostCollection;
use Modules\User\Entities\User;
use App\Http\Controllers\Controller;;

class PostUserController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(User::find($id)->posts);
    }
}
