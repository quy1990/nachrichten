<?php

namespace Modules\Comment\Http\Controllers;

use Modules\Comment\Resources\CommentCollection;
use Modules\User\Entities\User;
use App\Http\Controllers\Controller;;

class CommentUserController extends Controller
{
    public function __invoke(int $id): CommentCollection
    {
        return new CommentCollection(User::find($id)->comments);
    }
}
